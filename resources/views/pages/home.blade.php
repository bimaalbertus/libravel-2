@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        @if ($settings['banner_enabled'] == 1)
            <div class="w-full md:w-3/4 p-8 md:p-0">
                <x-banner />
            </div>
        @endif
        <div class="w-full md:w-3/4 p-8 md:p-0 md:py-24">
            <x-slider title="New Releases">
                @foreach ($all as $data)
                    <div class="py-8 px-4">
                        <a href="/book/{{ $data->id }}-{{ $data->slug }}">
                            <div class="relative hover:scale-110 transition-transform duration-300">
                                @if ($data->image_path)
                                    <x-image-skeleton src="{{ $data->image_path }}" alt="{{ $data->title }}"
                                        class="w-40 md:w-56 h-64 lg:h-52 xl:h-80 object-cover rounded-xl" loading="lazy" />
                                @else
                                    <x-image-skeleton src="https://placehold.co/2000x3000?text=No+Image+Available"
                                        alt="No Image Available" class="w-full h-full object-cover rounded-xl" />
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </x-slider>
            @foreach ($collections as $index => $collection)
                <x-slider title="{{ $collection->title }}" :datas="$collection->books" />
            @endforeach
        </div>
    </div>
@endsection
