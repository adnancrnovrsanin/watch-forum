<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['question'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function answers()
    {
        return $this->hasMany(PollAnswer::class);
    }

    public function allVotes()
    {
        $sum = 0;

        foreach ($this->answers as $answer) {
            $sum += $answer->usersAnswered()->count();
        }

        return $sum;
    }

    public function didUserVote()
    {
        if (!auth()->user()) {
            return false;
        }

        $user = User::find(auth()->user()->getAuthIdentifier());

        if (!$user) {
            return false;
        }

        return $this->answers()->whereHas('usersAnswered', fn ($query) => $query->where('user_id', $user->id))->exists();
    }
}
