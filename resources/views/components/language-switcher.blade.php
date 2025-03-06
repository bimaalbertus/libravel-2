@props([
    'type' => 'flag',
    'iconColor' => 'text-black dark:text-white',
])

@php
    $languages = [
        'en' => 'English',
        'id' => 'Bahasa Indonesia',
    ];
@endphp


@switch($type)
    @case($type == 'icon')
        <div x-data="{ open: false }" class="relative inline-block text-left">
            <div>
                <span @click="open = !open"
                    class="inline-flex items-center justify-center p-2 {{ $iconColor }} rounded-xl text-black dark:text-white bg-black dark:bg-white bg-opacity-0 hover:bg-opacity-10 dark:bg-opacity-0 dark:hover:bg-opacity-10 transition ease-linear cursor-pointer text-xl">
                    <i class="ti ti-language"></i>
                </span>
            </div>

            <div x-show="open" x-cloak x-on:click.away="open = false"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8"
                class="absolute -left-20">
                <div
                    class="flex flex-col justify-center w-48 border border-[#FFFFFF33] bg-light-bg-secondary dark:bg-dark-bg-secondary mt-5 p-1 rounded-lg">
                    @foreach ($languages as $locale => $language)
                        @if ($locale === app()->getLocale())
                            <div
                                class="flex items-center gap-2 p-4 w-full text-light-text-primary dark:text-dark-text-primary text-left text-sm cursor-not-allowed">
                                <span class="capitalize font-bold text-gray-400">
                                    {{ $language }}
                                </span>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($languages as $locale => $language)
                        @if ($locale !== app()->getLocale())
                            <form method="POST" action="{{ route('locale.switch') }}" class="block w-full">
                                @csrf
                                <input type="hidden" name="locale" value="{{ $locale }}">
                                <button type="submit"
                                    class="flex items-center gap-2 p-4 w-full text-left text-sm hover:bg-light-primary dark:hover:bg-dark-primary hover:text-white transition duration-200 ease-in-out rounded-md">
                                    <span class="capitalize">
                                        {{ $language }}
                                    </span>
                                </button>
                            </form>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    @break

    @default
        <div x-data="{ open: false }" class="relative inline-block text-left">
            <div>
                <span @click="open = !open" class="flex items-center gap-2 cursor-pointer">
                    <img src="{{ asset('assets/flags/' . app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}"
                        class="w-8 h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>

            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-5 w-48 rounded-md bg-white dark:bg-[#1e1e1e] border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5 z-50"
                x-transition>
                @foreach ($languages as $locale => $language)
                    @if ($locale === app()->getLocale())
                        <div class="flex items-center gap-2 p-4 w-full text-left text-[13px] cursor-not-allowed">
                            <img src="{{ asset('assets/flags/' . $locale . '.png') }}" alt="{{ $language }}"
                                class="w-8 h-full">
                            <span class="capitalize font-bold text-gray-400">
                                {{ $language }}
                            </span>
                        </div>
                    @else
                        <form method="POST" action="{{ route('locale.switch') }}" class="block w-full">
                            @csrf
                            <input type="hidden" name="locale" value="{{ $locale }}">
                            <button type="submit"
                                class="flex items-center gap-2 p-4 w-full text-left text-black dark:text-white text-[13px] hover:bg-light-primary dark:hover:bg-dark-secondary/20 hover:text-white transition duration-200 ease-in-out rounded-md">
                                <img src="{{ asset('assets/flags/' . $locale . '.png') }}" alt="{{ $language }}"
                                    class="w-8 h-full">
                                <span class="capitalize">
                                    {{ $language }}
                                </span>
                            </button>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
@endswitch
