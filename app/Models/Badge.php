<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modèle représentant un succès graphique (Badge).
 */
class Badge extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'icon', 'type'];

    /**
     * Utilisateurs ayant obtenu ce badge.
     * 
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badge')->withTimestamps();
    }
}
