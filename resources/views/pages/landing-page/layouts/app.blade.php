<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
    @vite(['resources/css/app.css'])
    @stack('style')
</head>

<body class="bg-[#F1F5F9] dark:bg-[#030806] text-[#222222] dark:text-[#fff] scroll-smooth font-euclid-circular-b">
    @include('layouts.navbar')
    @yield('main')
    @stack('script')
</body>

</html>
