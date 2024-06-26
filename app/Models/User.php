<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'avatar',
        'gender',
        'dob',
        'country',
        'JMBG',
        'email',
        'password',
        'approve_status',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function followedTopics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function votedComments()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function votedReplies()
    {
        return $this->belongsToMany(Reply::class);
    }

    public function blockedTopics()
    {
        return $this->belongsToMany(Topic::class, 'topic_user_block');
    }

    public function pollAnswers()
    {
        return $this->belongsToMany(PollAnswer::class);
    }
}
