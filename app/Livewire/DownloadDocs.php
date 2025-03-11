<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DownloadDocs extends Component
{
    public $bookId;

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

            return response()->download(
                $book->getFirstMedia('book.documents')->getPath(),
                $book->title . '.' . $book->getFirstMedia('book.documents')->extension
            );
        }

        abort(404, 'Dokumen tidak ditemukan.');
    }

    public function render()
    {
        return view('livewire.download-docs');
    }
}
