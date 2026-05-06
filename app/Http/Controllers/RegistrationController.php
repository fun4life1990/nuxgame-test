<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPlayerRequest;
use App\Services\PlayerRegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('registration.index');
    }

    public function store(RegisterPlayerRequest $request, PlayerRegistrationService $service): RedirectResponse
    {
        $link = $service->register($request->validated());

        return redirect()->route('play.show', $link);
    }
}
