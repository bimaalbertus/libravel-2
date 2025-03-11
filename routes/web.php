<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('collection')->name('collection.')->group(function () {
    Route::get('/{id}', [CollectionController::class, 'index'])->name('detail');
});

Route::post('/locale/switch', [LanguageController::class, 'switchLocale'])
    ->name('locale.switch');

Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::prefix('{username}')->name('profile.')->middleware(['authenticate', 'username'])->group(function () {
    Route::get('/', [AuthController::class, 'profile'])->name('index');
    Route::get('/read-later', [AuthController::class, 'readlater'])->name('read-later');
});
