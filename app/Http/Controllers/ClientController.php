<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Book;
use App\Models\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $settings = PageSettings::pluck('value', 'key')->toArray();
            $all = Book::paginate(10);
            $collections = Collection::paginate(5);

            return view('pages/home', compact('settings', 'all', 'collections'));
        } else {
            return view('pages/landing-page/index');
        }
    }

    public function about()
    {
        return view('pages/landing-page/about');
    }
}
