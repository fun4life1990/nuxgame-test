<?php

use App\Http\Controllers\PlayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\EnsureAccessLinkIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'index'])->name('home');
Route::post('/register', [RegistrationController::class, 'store'])->name('register');

Route::prefix('play/{accessLink}')
    ->middleware(EnsureAccessLinkIsValid::class)
    ->group(function (): void {
        Route::get('/', [PlayController::class, 'show'])->name('play.show');
        Route::post('regenerate', [PlayController::class, 'regenerate'])->name('play.regenerate');
        Route::post('deactivate', [PlayController::class, 'deactivate'])->name('play.deactivate');
        Route::post('lucky', [PlayController::class, 'lucky'])->name('play.lucky');
        Route::get('history', [PlayController::class, 'history'])->name('play.history');
    });
