<x-filament-panels::page>
    <div class="columns-3xs space-y-4">
        @foreach ($this->getImages() as $book)
            <div class="rounded shadow-md overflow-hidden">
                <img src="{{ $book->cover_path }}" alt="{{ $book->title }}" class="w-full object-cover">
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
