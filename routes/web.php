<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::get('/', [ClientController::class, 'index'])->name('home');

Route::prefix('book')->name('book.')->group(function () {
    Route::get('/{id}-{slug?}', [BookController::class, 'index'])->name('detail');
});

Route::prefix('author')->name('author.')->group(function () {
    Route::get('/{id}-{slug?}', [AuthorController::class, 'index'])->name('detail');
});

Route::prefix('publisher')->name('publisher.')->group(function () {
    Route::get('/{id}-{slug?}', [BookController::class, 'index'])->name('detail');
});

Route::post('/locale/switch', [LanguageController::class, 'switchLocale'])
    ->name('locale.switch');

Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'view']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::prefix('settings')->name('settings.')->middleware(['authenticate'])->group(function () {
    Route::get('/account', [AuthController::class, 'settings'])->name('account');
    Route::get('/security', [AuthController::class, 'security'])->name('security');
});
