<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function challenger()
    {
        return $this->belongsTo(User::class, 'challenger_id');
    }

    public function defender()
    {
        return $this->belongsTo(User::class, 'defender_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
