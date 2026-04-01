<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'premium_until' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(
            Task::class,
            Note::class,
            'user_id', // Foreign key on the users table...
            'note_id', // Foreign key on the tasks table...
            'id', // Local key on the users table...
            'id' // Local key on the notes table...
        );
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function hasActivePremium(): bool {
        return $this->premium_until !=null &&
            $this->premium_until->isFuture();
    }



}
