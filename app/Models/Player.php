<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = [
        'username',
        'phone_number',
    ];

    public function accessLinks(): HasMany
    {
        return $this->hasMany(AccessLink::class);
    }

    public function luckyResults(): HasMany
    {
        return $this->hasMany(LuckyResult::class);
    }
}
