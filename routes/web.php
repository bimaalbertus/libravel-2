<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/landingpage');
});

Route::post('/locale/switch', function () {
    $locale = session('locale') === 'en' ? 'id' : 'en';
    session(['locale' => $locale]);

    return redirect()->back();
})->name('locale.switch');
