<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLocale(Request $request)
    {
        $locale = $request->locale;

        if (auth()->check()) {
            /** @var User $user */

            $user = auth()->user();
            $user->update(['language' => $locale]);
        }
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
