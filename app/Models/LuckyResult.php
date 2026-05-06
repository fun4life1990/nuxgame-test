<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LuckyResult extends Model
{
    protected $fillable = [
        'player_id',
        'number',
        'is_win',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'is_win' => 'boolean',
        ];
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
