<?php

namespace App\Services;

use App\Models\AccessLink;
use App\Models\Player;
use Illuminate\Support\Str;

class AccessLinkService
{
    private const TOKEN_LENGTH = 40;

    private const LIFETIME_DAYS = 7;

    public function issueFor(Player $player): AccessLink
    {
        $link = new AccessLink;
        $link->token = $this->generateToken();
        $link->expires_at = now()->addDays(self::LIFETIME_DAYS);

        return $player->accessLinks()->save($link);
    }

    public function regenerate(AccessLink $link): AccessLink
    {
        $link->token = $this->generateToken();
        $link->expires_at = now()->addDays(self::LIFETIME_DAYS);
        $link->save();

        return $link;
    }

    public function deactivate(AccessLink $link): void
    {
        $link->deactivated_at = now();
        $link->save();
    }

    private function generateToken(): string
    {
        return Str::random(self::TOKEN_LENGTH);
    }
}
