@extends('layouts.app')
@section('title', $book->title . ' -')

@php
    $covers = $book->getCoverPath('all');
    $validCovers = array_filter($covers);
    $userReview = \App\Models\UserReview::where('book_id', $book->id)
        ->where('user_id', auth()->id())
        ->first();

    $tabs = [
        'infos' => [
            'label' => __('book.tabs.infos.label'),
            'icon' => '<i class="ti ti-file-info"></i>',
        ],
        'reviews' => [
            'label' => __('book.tabs.reviews.label'),
            'icon' => '<i class="ti ti-carambola"></i>',
        ],
        'media' => [
            'label' => __('book.tabs.media.label'),
            'icon' => '<i class="ti ti-photo"></i>',
        ],
    ];
@endphp

@section('content')
    <div class="flex flex-col py-12">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start w-full max-w-4xl mx-auto">
            <div class="max-w-64">
                @if (count($validCovers) > 1)
                    <x-slider :slidesToShow="1" :responsive="false" :slidesToScroll="1" :autoplay="false" :arrows="false"
                        :dots="true" :customPaging="true" :useThumbDots="true" :thumbnailSize="60">
                        @foreach ($validCovers as $path)
                            <x-image-skeleton :src="$path" alt="{{ $book->title }}"
                                class="aspect-[323/500] w-full h-auto rounded-xl px-4" />
                        @endforeach
                    </x-slider>
                @else
                    <x-image-skeleton :src="$book->getCoverPath()" alt="{{ $book->title }}"
                        class="aspect-[323/500] w-full h-auto rounded-xl" />
                @endif
            </div>
            <div class="flex flex-col items-center md:items-start max-w-xl mt-5 gap-3">
                <h1 class="font-semibold text-center md:text-start text-4xl">{{ $book->title }}</h1>
                <div class="flex items-center text-light-text-secondary dark:text-dark-text-secondary text-sm font-semibold">
                    {{ \Carbon\Carbon::parse($book->release_date)->format('d F Y') }}
                    <span class="font-bold mx-2">•</span>
                    {{ $book->page_count . ' ' . __('book.pages') }}
                </div>
                @if (count($book->authors) > 0)
                    <div class="mt-5">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ app()->getLocale() === 'en' ? (count($book->authors) > 1 ? 'Authors' : 'Author') : 'Penulis' }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-4">
                            @foreach ($book->authors as $author)
                                <a href="/author/{{ $author->id }}-{{ $author->slug }}">
                                    <div
                                        class="flex items-center gap-2 py-2 px-4 hover:bg-black/10 dark:hover:bg-white/10 rounded-lg transition ease-in-out">
                                        <x-image-skeleton :src="$author->image_path" :alt="$author->slug"
                                            class="size-12 object-cover rounded-full" />
                                        <span>{{ \Illuminate\Support\Str::limit($author->fullname, 20) }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full max-w-4xl mx-auto my-16">
            <x-tabs :tabs="$tabs" default-tab="infos" :has-icons="true" :border="false">
                <x-slot name="tab_infos">
                    <div
                        class="text-light-text-secondary dark:text-dark-text-secondary text-base capitalize max-w-96 md:max-w-full">
                        <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                            {{ __('book.synopsis') }}:</span>
                        <x-show-more class="text-justify" :text="$book->synopsis" />
                    </div>
                </x-slot>
                <x-slot name="tab_reviews">
                    <livewire:user-review :book_id="$book->id" :book_slug="$book->slug" />
                </x-slot>
                <x-slot name="tab_media">
                    media soon
                </x-slot>
            </x-tabs>
        </div>
    </div>
@endsection
