<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessLink extends Model
{
    protected $fillable = [
        'player_id',
        'token',
        'expires_at',
        'deactivated_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'deactivated_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function isValid(): bool
    {
        return $this->deactivated_at === null && $this->expires_at->isFuture();
    }

    public function scopeValid(Builder $query): Builder
    {
        return $query->whereNull('deactivated_at')->where('expires_at', '>', now());
    }
}
