<?php

namespace App\Http\Controllers;

use App\Models\AccessLink;
use App\Services\AccessLinkService;
use App\Services\LuckyDrawService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlayController extends Controller
{
    public function show(AccessLink $accessLink): View
    {
        return view('play.show', ['link' => $accessLink]);
    }

    public function regenerate(AccessLink $accessLink, AccessLinkService $service): RedirectResponse
    {
        $service->regenerate($accessLink);

        return redirect()->route('play.show', $accessLink);
    }

    public function deactivate(AccessLink $accessLink, AccessLinkService $service): RedirectResponse
    {
        $service->deactivate($accessLink);

        return redirect()->route('home');
    }

    public function lucky(AccessLink $accessLink, LuckyDrawService $service): RedirectResponse
    {
        $result = $service->play($accessLink->player);

        return redirect()
            ->route('play.show', $accessLink)
            ->with('lucky', $result);
    }

    public function history(AccessLink $accessLink, LuckyDrawService $service): View
    {
        return view('play.history', [
            'link' => $accessLink,
            'results' => $service->historyFor($accessLink->player),
        ]);
    }
}
