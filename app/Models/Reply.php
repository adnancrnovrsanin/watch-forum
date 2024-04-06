<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'comment_id', 'user_id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usersVoted()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('vote')
            ->withTimestamps();
    }

    public function userVote(?User $user)
    {
        if (!$user) {
            return null;
        }

        $vote = $this->usersVoted()->where('user_id', $user->id)->first();
        return $vote ? $vote->pivot->vote : null;
    }

    public function voteSum()
    {
        return $this->usersVoted()->sum('vote');
    }

    public function hasVoted(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->usersVoted->contains($user);
    }
}
