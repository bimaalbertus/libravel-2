@extends('layouts.app', ['nav' => false])

@section('content')
    <nav class="fixed top-5 right-5 flex items-center gap-4">
        <x-theme-toggle type="small" />
        <x-language-switcher />
    </nav>
    <div class="flex gap-8 flex-col items-center justify-center">
        <x-logo />
        <div class="flex flex-col gap-10 p-10 rounded-xl w-full max-w-md bg-white dark:bg-neutral-900 shadow-xl">
            <div class="space-y-2">
                <x-logo type="icon" />
                <h3 class="font-semibold text-lg max-w-52">{{ __('pages/login.greeting') }}</h3>
            </div>
            <form action="{{ route('auth.login') }}" method="POST" class="w-full space-y-4">
                @csrf
                <div x-data class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                    <label for="username" class="w-fit pl-0.5 text-sm">Username</label>
                    <input id="username" type="text" {{ old('username') }}
                        class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white {{ $errors->has('username') ? 'border-red-500 dark:border-red-600' : '' }}"
                        name="username" />
                    @error('username')
                        <small class="pl-0.5 text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                    <div x-data="{ showPassword: false }" class="relative">
                        <label for="password" class="w-fit pl-0.5 text-sm">Password</label>
                        <input :type="showPassword ? 'text' : 'password'" id="passwordInput"
                            class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white {{ $errors->has('password') ? 'border-red-500 dark:border-red-600' : '' }}"
                            name="password" autocomplete="current-password" />
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-2.5 top-3/4 -translate-y-3/4 text-neutral-600 dark:text-neutral-300"
                            aria-label="Show password">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <small class="pl-0.5 text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full p-2 rounded-md bg-black dark:bg-white text-white dark:text-black hover:opacity-80 transition duration-200 ease-in-out font-semibold uppercase text-xs">{{ __('pages/login.action') }}</button>
            </form>
        </div>
    </div>
    <img src="/assets/book.png" alt="" class="hidden dark:block fixed bottom-0 right-1/2 opacity-40 -z-10">
@endsection
