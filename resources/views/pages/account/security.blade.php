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
            <div
                class="flex flex-col w-full border bg-white dark:bg-black/40 border-black/30 dark:border-white/30 rounded-lg">
                <div class="w-full py-4 px-6">
                    <h2 class="font-bold text-xl mb-4">{{ __('profile.delete_account') }}</h2>
                    <p class="text-sm">{{ __('profile.delete_account_description') }}</p>
                </div>
                <div class="flex w-full items-center justify-end py-3 px-6 bg-red-400/30 dark:bg-red-400/10">
                    <livewire:request-account-deletion />
                </div>
            </div>
        </div>
    </section>
@endsection
