<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function view()
    {
        return view('pages.login');
    }

    public function settings()
    {
        return view('pages.account.settings');
    }

    public function security()
    {
        return view('pages.account.security');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|min:3|max:32',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }
}
