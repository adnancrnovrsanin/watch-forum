<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'approve_status', 'user_id'];

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function isFollowedBy(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->followers->contains($user);
    }

    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'topic_user_block');
    }

    public function isBlockedBy(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->blockedUsers->contains($user);
    }

    public function polls(): HasMany
    {
        return $this->hasMany(Poll::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
