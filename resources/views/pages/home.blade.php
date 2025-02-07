@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center">
        @if ($settings['banner_enabled'] == 1)
            <div class="w-full md:w-3/4 p-8 md:p-0">
                <x-banner />
            </div>
        @endif
    </div>
@endsection
