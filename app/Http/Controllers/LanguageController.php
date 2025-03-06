<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function switchLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:id,en',
        ]);

        $locale = $request->locale;

        if (Auth::check()) {
            /** @var User $user */

            $user = Auth::user();
            $user->update(['language' => $locale]);
        }

        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
