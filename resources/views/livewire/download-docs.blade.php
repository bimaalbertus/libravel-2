<div>
    @if ($book = \App\Models\Book::find($bookId))
        @if ($book->getFirstMedia('book.documents'))
            <button wire:click="downloadDocument"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Unduh Dokumen
            </button>
        @else
            <p>Dokumen tidak tersedia.</p>
        @endif
    @else
        <p>Buku tidak ditemukan.</p>
    @endif
</div>
