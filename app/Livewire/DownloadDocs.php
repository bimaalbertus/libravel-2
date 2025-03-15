<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DownloadDocs extends Component
{
    public $bookId;
    public $downloadOpen = false;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
    }

    public function downloadDocument()
    {
        $book = Book::find($this->bookId);

        if ($book && $book->getFirstMedia('book.documents')) {
            Download::create([
                'book_id' => $this->bookId,
                'user_id' => Auth::id(),
                'downloaded_at' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $this->downloadOpen = false;

            return redirect()->route(
                'private-file.download',
                [
                    'book' => $book,
                    'mediaId' => $book->getFirstMedia('book.documents')->id,
                ]
            );
        }

        abort(404);
    }

    public function render()
    {
        $book = Book::find($this->bookId);
        $size = $book->getFirstMedia('book.documents')->human_readable_size ?? null;

        return view('livewire.download-docs', ['book' => $book, 'size' => $size]);
    }
}
