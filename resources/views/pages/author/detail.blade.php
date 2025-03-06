@extends('layouts.app')
@section('title', $author->fullname . ' -')

@php
    $covers = $author->getCoverPath('all');
    $validCovers = array_filter($covers);

    $birthdate = \Carbon\Carbon::parse($author->birthdate);
    $deathdate = \Carbon\Carbon::parse($author->deathdate);
@endphp

@section('content')
    <div class="flex flex-col py-2 md:mx-32">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="max-w-64">
                @if (count($validCovers) > 1)
                    <x-slider :slidesToShow="1" :responsive="false" :slidesToScroll="1" :autoplay="false" :arrows="false"
                        :dots="true" :customPaging="true" :useThumbDots="true" :thumbnailSize="60">
                        @foreach ($validCovers as $path)
                            <x-image-skeleton :src="$path" alt="{{ $author->slug }}"
                                class="aspect-[323/500] w-full h-auto rounded-xl px-4" />
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
                <x-button class="inline-flex items-center gap-2 w-full max-w-32 px-2"
                    href="https://www.google.com/search?q={{ $author->fullname }}" target="_blank">
                    <span>
                        Google It!
                    </span>
                    <i class="ti ti-external-link"></i>
                </x-button>
                <div
                    class="text-light-text-secondary dark:text-dark-text-secondary text-sm capitalize max-w-96 md:max-w-full">
                    <span class="text-light-text-primary dark:text-dark-text-primary mr-2 font-semibold">
                        {{ __('author.bio') }}:</span>
                    <x-show-more class="text-justify" :text="$author->bio" />
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
