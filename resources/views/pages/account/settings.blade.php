@extends('layouts.app')

@section('content')
    <h1 class="py-8 px-4 md:px-32 text-3xl font-medium">{{ __('profile.title') }}</h1>
    <hr class="border-black/30 dark:border-white/30">
    <section class="relative py-8 px-4 md:px-32 flex flex-col md:flex-row justify-between">
        <div class="md:w-1/4">
            <x-sidenav :links="[
                [
                    'url' => '/settings/account',
                    'label' => __('navigation/navigation.links.general'),
                    'active' => 'settings/account',
                ],
                [
                    'url' => '/settings/security',
                    'label' => __('navigation/navigation.links.security'),
                    'active' => 'settings/security',
                ],
            ]" />
        </div>

        <div class="flex flex-col gap-8 p-4 md:w-3/4">
            <div class="flex flex-col border bg-white dark:bg-black/40 border-black/30 dark:border-white/30 rounded-lg">
                @if ($user->status === 'admin')
                    <livewire:username-update />
                @else
                    <livewire:username-request />
                @endif
            </div>

            <div class="flex flex-col border bg-white dark:bg-black/60 border-black/30 dark:border-white/30 rounded-lg">
                <livewire:fullname-update />
            </div>

            <div class="flex flex-col border bg-white dark:bg-black/40 border-black/30 dark:border-white/30 rounded-lg">
                <livewire:browser-sessions />
            </div>
        </div>
    </section>
@endsection
