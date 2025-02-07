@php
    $languages = [
        'en' => 'English',
        'id' => 'Bahasa Indonesia',
    ];
@endphp


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
                        class="flex items-center gap-2 p-4 w-full text-left text-white text-[13px] hover:bg-light-primary dark:hover:bg-dark-secondary/20 hover:text-white transition duration-200 ease-in-out rounded-md">
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
