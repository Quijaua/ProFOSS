<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelVote\Traits\Voter;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Voter;

    protected $fillable = [
        'name',
        'email',
        'password',
        'local',
        'phone',
        'website',
        'about'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function hasUpvoted(Model $object): bool
    {
        return ($this->relationLoaded('votes') ? $this->votes : $this->votes())
                ->where('votable_id', $object->getKey())
                ->where('votable_type', $object->getMorphClass())
                ->where('votes', '>=', 0)
                ->exists();
    }

    public function hasDownvoted(Model $object): bool
    {
        return ($this->relationLoaded('votes') ? $this->votes : $this->votes())
            ->where('votable_id', $object->getKey())
            ->where('votable_type', $object->getMorphClass())
            ->where('votes', '<=', 0)
            ->exists();
    }
}
