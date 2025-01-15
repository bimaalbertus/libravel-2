@php
    $languages = [
        'en' => 'English',
        'id' => 'Bahasa Indonesia',
    ];
@endphp


<div x-data="{ open: false }" class="relative inline-block text-left">
    <div>
        <button @click="open = !open"
            class="flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-700 transition">
            <img src="{{ asset('assets/flags/' . app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}"
                class="w-8 h-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.away="open = false"
        class="absolute right-0 mt-5 w-48 rounded-md bg-[#0035184d] border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5 z-50"
        x-transition>
        @foreach ($languages as $locale => $language)
            <form method="POST" action="{{ route('locale.switch') }}" class="block w-full">
                @csrf
                <input type="hidden" name="locale" value="{{ $language }}">
                <button type="submit"
                    class="flex items-center gap-2 p-4 w-full text-left text-white text-[13px] hover:text-[#02F67C] hover:bg-light-btn-primary/30 transition duration-200 ease-in-out rounded-md">
                    <img src="{{ asset('assets/flags/' . $locale . '.png') }}" alt="{{ $language }}"
                        class="w-8 h-full">
                    <span class="capitalize">
                        {{ $language }}
                    </span>
                </button>
            </form>
        @endforeach
    </div>
</div>
