<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answer', 'votes'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function usersAnswered()
    {
        return $this->belongsToMany(User::class);
    }

    public function vote(User $user)
    {
        $this->usersAnswered()->attach($user);
    }

    public function calculatePercentage()
    {
        $totalVotes = $this->poll->allVotes();
        $votes = $this->usersAnswered()->count();

        return $totalVotes > 0 ? ($votes / $totalVotes) * 100 : 0;
    }

    public function didUserVoteThisAnswer(?User $user)
    {
        if (!$user) {
            return false;
        }

        return $this->usersAnswered()->where('user_id', $user->id)->exists();
    }
}
