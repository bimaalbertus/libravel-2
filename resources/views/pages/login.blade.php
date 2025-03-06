@extends('layouts.app', ['nav' => false])
@section('title', __('pages/login.page.title') . ' -')

@section('content')
    <nav class="fixed top-5 w-full flex items-center justify-between px-4 md:px-48 z-50">
        <a href="/" class="hover:scale-105 transition ease-in-out text-white">
            <x-logo />
        </a>
        <div class="flex gap-2">
            <x-theme-toggle type="icon" iconColor="text-white" />
            <x-language-switcher type="icon" iconColor="text-white" />
        </div>
    </nav>
    <div
        class="absolute top-0 left-0 w-full h-full -z-10 bg-[url('/public/gradients/wide.webp')] lg:bg-[url('/public/gradients/portrait-2.webp')] bg-dark-gradient bg-cover bg-center dark:bg-bottom dark:bg-[#101110]">
    </div>
    <div class="w-full h-full flex flex-col items-center justify-center py-16">
        <div
            class="flex flex-col gap-10 p-10 rounded-2xl w-full max-w-lg bg-light-bg-primary dark:bg-dark-bg-primary shadow-2xl border-[5px] border-purple-800/30 dark:border-none">
            <div class="space-y-2">
                <x-logo type="icon" />
                <h3 class="font-semibold text-lg max-w-52">{{ __('pages/login.greeting') }}</h3>
            </div>
            <livewire:login />
        </div>
    </div>
@endsection
