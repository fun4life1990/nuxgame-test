<?php

namespace App\Services;

use App\Models\AccessLink;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class PlayerRegistrationService
{
    public function __construct(private AccessLinkService $accessLinks) {}

    /**
     * @param  array{username: string, phone_number: string}  $data
     */
    public function register(array $data): AccessLink
    {
        return DB::transaction(function () use ($data): AccessLink {
            $player = Player::create($data);

            return $this->accessLinks->issueFor($player);
        });
    }
}
