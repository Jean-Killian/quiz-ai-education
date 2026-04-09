<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Modèle représentant un défi asynchrone entre deux opérateurs.
 * 
 * @property string $id UUID unique du duel
 * @property string $status État du duel (pending, open, completed, expired)
 */
class Duel extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'challenger_id',
        'defender_id',
        'quiz_id',
        'challenger_score',
        'challenger_time_ms',
        'defender_score',
        'defender_time_ms',
        'status',
        'winner_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Initialisation du modèle : génération de l'UUID.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * L'initiateur du défi.
     * 
     * @return BelongsTo
     */
    public function challenger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'challenger_id');
    }

    /**
     * Le défenseur recevant le défi.
     * 
     * @return BelongsTo
     */
    public function defender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'defender_id');
    }

    /**
     * Le quiz servant de support au duel.
     * 
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Le vainqueur final après résolution.
     * 
     * @return BelongsTo
     */
    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
