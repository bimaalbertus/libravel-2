@extends('layouts.app', ['nav' => false])

@section('content')
    @include('layouts.navbar')

    <main class="font-euclid-circular-b bg-[#7A5D3F]">
        @include('pages.landing-page.components.jumbotron')
        @include('pages.landing-page.components.infos')
    </main>

    <div class="px-4 md:px-16 py-32 bg-[#7A5D3F]">
        @include('pages.landing-page.layouts.footer', [
            'title' => __('navigation/navigation.jumbotron.subtitle_2'),
        ])
    </div>
@endsection
