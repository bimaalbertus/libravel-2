@extends('layouts.app')
@section('title', $author->fullname . ' -')

@php
    $covers = $author->getCoverPath('all');
    $validCovers = array_filter($covers);

    $birthdate = \Carbon\Carbon::parse($author->birthdate);
    $deathdate = \Carbon\Carbon::parse($author->deathdate);
@endphp

@section('content')
    <div class="flex flex-col py-2 md:px-32">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="max-w-64">
                @if (count($validCovers) > 1)
                    <x-slider :slidesToShow="1" :responsive="false" :slidesToScroll="1" :autoplay="false" :arrows="false"
                        :dots="true" :customPaging="true" :useThumbDots="true" :thumbnailSize="60">
                        @foreach ($validCovers as $path)
                            <x-image-skeleton :src="$path" alt="{{ $author->slug }}"
                                class="aspect-[323/500] w-full h-auto rounded-xl px-4 object-cover object-center" />
                        @endforeach
                    </x-slider>
                @else
                    <x-image-skeleton :src="$author->getCoverPath()" alt="{{ $author->slug }}"
                        class="aspect-[323/500] object-cover w-full h-auto rounded-xl" />
                @endif
            </div>
            <div class="flex flex-col items-center md:items-start max-w-xl mt-5 gap-3">
                <h1 class="font-semibold text-center md:text-start text-4xl">{{ $author->fullname }}</h1>
                <div class="flex items-center text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize">
                    <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                        {{ __('author.birth') }}:</span>
                    <span>{{ $birthdate->format('d F, Y') }}</span>
                </div>
                @if ($author->deathdate)
                    <div
                        class="flex items-center text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize">
                        <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                            {{ __('author.death') }}:</span>
                        <span>{{ $deathdate->format('d F, Y') }}</span>
                    </div>
                @else
                    <div
                        class="flex items-center text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize">
                        <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                            {{ __('author.age') }}:</span>
                        <span>{{ $birthdate->age . ' ' . __('author.years') }}</span>
                    </div>
                @endif

                <div
                    class="text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize max-w-96 md:max-w-full">
                    <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                        {{ __('author.bio') }}:</span>
                    <x-show-more class="text-justify" :text="$author->bio" />
                </div>

                <div class="flex items-center gap-2">
                    <x-button class="inline-flex items-center gap-2 p-2"
                        href="https://www.google.com/search?q={{ $author->fullname }}" width="w-10" height="h-10"
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
                            <svg x-show="copied" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
        @if ($author->books)
            <div class="mx-auto md:mx-0 mt-20 max-w-96 md:max-w-full">
                <x-slider title="{{ __('navigation/navigation.search.models.book') }}" :datas="$author->books" />
            </div>
        @endif
    </div>
@endsection
