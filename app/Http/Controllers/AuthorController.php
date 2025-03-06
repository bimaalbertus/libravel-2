<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index($id, $slug)
    {
        $author = Author::findOrFail($id);

        if (is_null($slug)) {
            return redirect()->route('author.detail', ['id' => $id, 'slug' => $author->slug]);
        }

        if ($slug !== $author->slug) {
            return redirect()->route('author.detail', ['id' => $id, 'slug' => $author->slug]);
        }

        return view('pages.author.detail', compact('author'));
    }
}
