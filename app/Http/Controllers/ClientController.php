<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $carousel = Banner::where('is_carousel', true)->get();
            $non_carousel = Banner::where('is_carousel', false)->get();
            $settings = PageSettings::pluck('value', 'key')->toArray();

            return view('pages/home', compact('carousel', 'non_carousel', 'settings'));
        } else {
            return view('pages/landingpage');
        }
    }
}
