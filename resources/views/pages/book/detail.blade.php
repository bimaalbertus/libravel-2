@extends('layouts.app')
@section('title', $book->title . ' -')

@php
    $covers = $book->getCoverPath('all');
    $validCovers = array_filter($covers);
    $userReview = \App\Models\UserReview::where('book_id', $book->id)
        ->where('user_id', auth()->id())
        ->first();

    $tabs = [
        'reviews' => [
            'label' => __('book.tabs.reviews.label'),
            'icon' => '<i class="ti ti-carambola"></i>',
        ],
    ];
@endphp

@section('content')
    <div x-data="{ fileOpen: false }" class="flex flex-col justi py-12">
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

                {{-- Cover --}}
                <div
                    class="flex items-center text-light-text-secondary dark:text-dark-text-secondary text-sm font-semibold">
                    {{ \Carbon\Carbon::parse($book->release_date)->format('d F Y') }}
                    <span class="font-bold mx-2">•</span>
                    {{ $book->page_count . ' ' . __('book.pages') }}
                </div>

                {{-- Synopsys --}}
                <div
                    class="text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize max-w-96 md:max-w-full">
                    <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                        {{ __('book.synopsis') }}:</span>
                    <x-show-more class="text-justify" :text="$book->synopsis" />
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-2">
                    <x-button class="inline-flex items-center gap-2 p-2"
                        href="https://www.google.com/search?q=book+{{ $book->title }}" width="w-10" height="h-10"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-brand-google">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" />
                        </svg>
                    </x-button>
                    <div x-data="{
                        copied: false,
                        copyLink() {
                            const currentUrl = window.location.href;
                            navigator.clipboard.writeText(currentUrl).then(() => {
                                this.copied = true;
                                setTimeout(() => this.copied = false, 2000);
                            }).catch(err => {
                                console.error('Could not copy text: ', err);
                                alert('Failed to copy link.');
                            });
                        }
                    }">
                        <x-button x-on:click="copyLink()" width="w-10" height="h-10">
                            <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 15l6 -6" />
                                <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                <path
                                    d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                            </svg>
                            <svg x-show="copied" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </x-button>
                    </div>
                    @if ($book->getFirstMedia('book.documents'))
                        <x-button x-on:click="fileOpen = !fileOpen" class="inline-flex items-center gap-2 p-2"
                            width="w-10" height="h-10" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </x-button>
                    @endif
                    <livewire:download-docs :bookId="$book->id" />
                </div>

                {{-- Authors --}}
                @if (count($book->authors) > 0)
                    <div>
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

            @if ($book->getFirstMedia('book.documents'))
                {{-- Doc Modal --}}
                <x-modal open="fileOpen" zIndex="9999">
                    <x-docs-viewer :url="route('private-file.show', [
                        'book' => $book,
                        'mediaId' => $book->getFirstMedia('book.documents')->id,
                    ])" />
                </x-modal>
            @endif
        </div>

        <div class="w-full max-w-4xl mx-auto my-16">
            <x-tabs :tabs="$tabs" default-tab="reviews" :has-icons="true" :border="false">
                <x-slot name="tab_reviews">
                    <livewire:user-review :book_id="$book->id" :book_slug="$book->slug" />
                </x-slot>
            </x-tabs>
        </div>
    </div>
@endsection
