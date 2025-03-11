@extends('layouts.app')
@section('title', ($user->fullname ?? $user->username) . ' -')

@php
    $tabs = [
        'infos' => [
            'label' => $user->username,
            'icon' => '<x-avatar-display type="circle" :size="20" />',
        ],
        'account' => [
            'label' => __('profile.page.account_settings'),
            'icon' => '<i class="ti ti-user"></i>',
        ],
        'security' => [
            'label' => __('profile.page.account_security'),
            'icon' => '<i class="ti ti-shield-lock"></i>',
        ],
    ];
@endphp

@section('content')
    <x-container class="py-0">
        <div class="mx-auto w-full">
            <x-tabs :tabs="$tabs" default-tab="infos" :has-icons="true">
                <x-slot name="tab_infos">
                    <x-account::profile-banner />

                    <h1 class="font-semibold text-2xl">{{ $user->username }}'s Want to Read List</h1>
                </x-slot>
                <x-slot name="tab_account">
                    <div class="text-light-text-secondary dark:text-dark-text-secondary text-base capitalize">
                        <x-account::account />
                    </div>
                </x-slot>
                <x-slot name="tab_security">
                    <x-account::security />
                </x-slot>
            </x-tabs>
        </div>
    </x-container>
@endsection
