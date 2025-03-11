<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index($id, $slug = null)
    {
        $book = Book::with('reviews.user')->findOrFail($id);

        if (is_null($slug)) {
            return redirect()->route('book.detail', ['id' => $id, 'slug' => $book->slug]);
        }

        if ($slug !== $book->slug) {
            return redirect()->route('book.detail', ['id' => $id, 'slug' => $book->slug]);
        }

        return view('pages.book.detail', compact('book'));
    }
}
