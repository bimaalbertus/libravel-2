<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(Book $book, $mediaId)
    {
        $media = $book->getMedia('book.documents')->where('id', $mediaId)->first();

        if ($media) {
            return response()->file($media->getPath());
        }

        abort(404);
    }

    public function download(Book $book, $mediaId)
    {
        $media = $book->getMedia('book.documents')->where('id', $mediaId)->first();

        if ($media && auth()->check()) {
            return response()->download($media->getPath(), $media->file_name);
        }

        abort(404);
    }
}
