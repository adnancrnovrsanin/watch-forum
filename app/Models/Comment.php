<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'conversation_id', 'user_id'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
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
