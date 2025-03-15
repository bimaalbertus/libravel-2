@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        @if ($settings['banner_enabled'] == 1)
            <div class="w-full md:w-3/4 p-8 md:p-0">
                <x-banner />
            </div>
        @endif
        <div class="w-full md:w-3/4 p-8 md:p-0 md:py-24">
            @foreach ($collections as $index => $collection)
                <x-slider title="{{ $collection->title }}" :datas="$collection->books" />
            @endforeach
        </div>
    </div>
@endsection
