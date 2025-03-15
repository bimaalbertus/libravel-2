<div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
    @foreach ($books as $book)
        <div class="w-full">
            <a href="{{ route('filament.libramint.resources.crud.book.view', $book->id) }}">
                <img src="{{ $book->getCoverPath('single') }}" alt="{{ $book->title }}" class="w-full h-auto rounded-md">
            </a>
        </div>
    @endforeach
</div>
