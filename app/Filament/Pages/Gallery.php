<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Book;

class Gallery extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery';
    protected static ?string $slug = 'gallery';
    protected static string $view = 'filament.pages.gallery';

    public function getImages()
    {
        $books = Book::all();
        return $books;
    }
}
