@extends('layouts.app', ['nav' => false])
@section('title', __('pages/login.page.title') . ' -')

@section('content')
    <nav class="fixed top-5 w-full flex items-center justify-between px-4 md:px-48 z-50">
        <a href="/" class="hover:scale-105 transition ease-in-out">
            <x-logo />
        </a>
        <div class="flex gap-2">
            <x-theme-toggle type="icon" />
            <x-language-switcher type="icon" />
        </div>
    </nav>
    <img src="/gradients/docs-left.png"
        class="fixed -z-10 -left-32 w-[65rem] opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none transition-transform-opacity motion-reduce:transition-none !duration-300 rounded-large"
        alt="docs left background" data-loaded="true" />
    <img src="/gradients/docs-right.png"
        class="fixed -z-10 -right-96 -top-72 w-[75rem] rotate-180 opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none transition-transform-opacity motion-reduce:transition-none !duration-300 rounded-large"
        alt="docs right background" data-loaded="true" />
    <section class="w-full min-h-screen flex flex-col items-center justify-center">
        <div class="flex flex-col gap-10 p-10 rounded-2xl w-full max-w-lg">
            <div class="space-y-2">
                <x-logo type="icon" />
                <h3 class="font-semibold text-lg max-w-52">{{ __('pages/login.greeting') }}</h3>
            </div>
            <livewire:login />
        </div>
    </section>
@endsection
