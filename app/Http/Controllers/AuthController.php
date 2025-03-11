<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function profile()
    {
        return view('pages.account.profile');
    }

    public function readlater($username)
    {
        $books = Auth::user()->readLaters()->paginate(10);

        return view('pages.account.read-later', compact('books'));
    }
}
