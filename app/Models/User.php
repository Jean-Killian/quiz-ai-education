<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle représentant un opérateur du réseau (Utilisateur).
 * 
 * @property string $name Nom de l'opérateur
 * @property int $global_score Score de réputation cumulé
 * @property int $current_streak Série actuelle de victoires parfaites
 * @property int $max_streak Record de série de victoires
 */
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

    /**
     * Casts des attributs.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Récupère l'URL de l'avatar de l'utilisateur (photo de profil ou fallback UI-Avatars).
     * 
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        return $this->profile_photo 
            ? asset('storage/' . $this->profile_photo) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=22c55e&background=0f172a';
    }

    /**
     * Relation vers les quiz passés (missions) avec le score et le temps.
     * 
     * @return BelongsToMany
     */
    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class)
                    ->withPivot('score', 'time_ms')
                    ->withTimestamps();
    }

    /**
     * Duels initiés par l'utilisateur.
     * 
     * @return HasMany
     */
    public function sentDuels(): HasMany
    {
        return $this->hasMany(Duel::class, 'challenger_id');
    }

    /**
     * Duels reçus par l'utilisateur.
     * 
     * @return HasMany
     */
    public function receivedDuels(): HasMany
    {
        return $this->hasMany(Duel::class, 'defender_id');
    }

    /**
     * Duels remportés par l'utilisateur.
     * 
     * @return HasMany
     */
    public function wonDuels(): HasMany
    {
        return $this->hasMany(Duel::class, 'winner_id');
    }

    /**
     * Badges et succès débloqués par l'utilisateur.
     * 
     * @return BelongsToMany
     */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badge')->withTimestamps();
    }
}