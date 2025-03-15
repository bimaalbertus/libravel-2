@extends('layouts.app')
@section('title', __('account.page.read_later.title') . ' -')

@section('content')
    <x-container class="flex-col gap-8 py-0">
        <div
            class="sticky top-16 z-50 flex flex-col bg-light-bg-primary dark:bg-dark-bg-primary py-4 border-b border-black dark:border-white">
            <h1
                class="font-semibold font-geist-sans text-5xl mx-auto border-2 border-white px-8 py-2 rounded-3xl box-shadow-purple">
                {{ __('account.page.read_later.title') }}</h1>
            {{ $books->links('pagination.paginator') }}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($books as $book)
                <div class="flex gap-2">
                    <x-image-skeleton :src="$book->getCoverPath()" :alt="$book->slug" class="w-28 rounded-lg" />
                    <div class="flex flex-col gap-1">
                        <h2 class="text-2xl font-bold font-fenix underline underline-offset-[6px]">{{ $book->title }}</h2>
                        @if ($book->authors)
                            <span class="text-lg">
                                @foreach ($book->authors as $author)
                                    {{ $author->fullname }}
                                @endforeach
                            </span>
                        @endif

                        <div class="inline-flex items-center gap-2 font-semibold">
                            <i class="ti ti-star text-yellow-400"></i>
                            <span>4.4</span>
                        </div>

                        <div class="mt-auto font-semibold text-light-text-secondary dark:text-dark-text-secondary">
                            {{ \Carbon\Carbon::parse($book->release_date)->format('d F Y') }}
                            <span class="font-bold mx-2">•</span>
                            {{ $book->page_count . ' ' . __('book.pages') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-container>
@endsection
