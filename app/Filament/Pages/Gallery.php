<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Book;
use App\Models\Author;
use App\Models\Avatar;

class Gallery extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery';
    protected static ?string $slug = 'gallery';
    protected static string $view = 'filament.pages.gallery';

    public int $page = 1;
    public int $perPage = 12;
    public array $loadedImages = [];
    public bool $hasMorePages = true;

    public function mount(): void
    {
        $this->loadMore();
    }

    public function loadMore(): void
    {
        if (!$this->hasMorePages) {
            return;
        }

        $books = Book::paginate($this->perPage, ['*'], 'page', $this->page);
        $authors = Author::paginate($this->perPage, ['*'], 'page', $this->page);

        $this->loadedImages['books'] = array_merge($this->loadedImages['books'] ?? [], $books->items());
        $this->loadedImages['authors'] = array_merge($this->loadedImages['authors'] ?? [], $authors->items());

        $this->page++;
        $this->hasMorePages = $books->hasMorePages() || $authors->hasMorePages();
    }
}
