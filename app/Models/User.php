<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'global_score',
        'profile_photo',
        'current_streak',
        'max_streak',
        'theme',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarUrlAttribute()
    {
        return $this->profile_photo 
            ? asset('storage/' . $this->profile_photo) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=22c55e&background=0f172a';
    }

    // A user can have many quizzes (scores)
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)
                    ->withPivot('score', 'time_ms')
                    ->withTimestamps();
    }

    public function sentDuels()
    {
        return $this->hasMany(Duel::class, 'challenger_id');
    }

    public function receivedDuels()
    {
        return $this->hasMany(Duel::class, 'defender_id');
    }

    public function wonDuels()
    {
        return $this->hasMany(Duel::class, 'winner_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badge')->withTimestamps();
    }
}