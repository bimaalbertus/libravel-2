@php
    $nav = $nav ?? true;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ config('app.name') }}</title>
    @yield('style')
    @livewireStyles()
    @livewireScripts()
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body class="bg-light-bg dark:bg-dark-bg text-light-on-bg dark:text-dark-on-bg scroll-smooth font-euclid-circular-b">

    @if ($nav)
        @include('layouts.navbar')

        <main class="py-16 md:py-28">
            @yield('content')
        </main>
    @else
        <main class="py-8 md:py-14">
            @yield('content')
        </main>
    @endif

    <x-toaster-hub />

    <div class="hidden md:block">
        <x-alert position="top-right" :duration="5000" :maxToasts="5" :animation="true" :pauseOnHover="true"
            :showProgress="true" />
    </div>

    <div class="md:hidden">
        <x-alert position="bottom-center" :duration="5000" :maxToasts="5" :animation="true" :pauseOnHover="true"
            :showProgress="true" />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('script')
</body>

</html>
