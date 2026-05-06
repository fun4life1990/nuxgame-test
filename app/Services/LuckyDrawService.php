<?php

namespace App\Services;

use App\Models\LuckyResult;
use App\Models\Player;
use Illuminate\Support\Collection;

class LuckyDrawService
{
    public function play(Player $player): LuckyResult
    {
        $number = random_int(1, 1000);
        $isWin = $number % 2 === 0;

        $result = new LuckyResult;
        $result->number = $number;
        $result->is_win = $isWin;
        $result->amount = $this->calculateAmount($number, $isWin);

        return $player->luckyResults()->save($result);
    }

    /**
     * @return Collection<int, LuckyResult>
     */
    public function historyFor(Player $player, int $limit = 3): Collection
    {
        return $player->luckyResults()
            ->latest('id')
            ->limit($limit)
            ->get();
    }

    private function calculateAmount(int $number, bool $isWin): int
    {
        if (! $isWin) {
            return 0;
        }

        $percent = match (true) {
            $number > 900 => 70,
            $number > 600 => 50,
            $number > 300 => 30,
            default => 10,
        };

        return (int) floor($number * $percent / 100);
    }
}
