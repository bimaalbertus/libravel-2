<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::get('/', [ClientController::class, 'index']);

Route::post('/locale/switch', [LanguageController::class, 'switchLocale'])
    ->name('locale.switch');

Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'view']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::prefix('settings')->name('settings.')->middleware(['authenticate', HandlePrecognitiveRequests::class])->group(function () {
    Route::get('/account', [AuthController::class, 'settings'])->name('account');
    Route::get('/security', [AuthController::class, 'security'])->name('security');
});
