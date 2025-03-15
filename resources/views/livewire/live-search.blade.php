@php
    $tabsWithoutIcons = [
        'books' => ['label' => 'Books'],
        'authors' => ['label' => 'Authors'],
        'publishers' => ['label' => 'Publishers'],
    ];
@endphp

<div x-data="{
    searchOpen: @entangle('isOpen'),
}" x-init="$watch('searchOpen', value => {
    if (value) {
        setTimeout(() => { $refs.searchInput.focus() }, 50)
    } else {
        $wire.resetSearch()
    }
})"
    @keydown.window="
    if (searchOpen && $event.key.length === 1 && !$event.metaKey && !$event.ctrlKey && !$event.altKey) {
        $refs.searchInput.focus();
    }">
    @if ($isIconOnly)
        <div x-data @keydown.window.ctrl.k.prevent="searchOpen = true"
            class="inline-flex items-center justify-center p-2 text-black dark:text-white rounded-xl text-black dark:text-white bg-black dark:bg-white bg-opacity-0 hover:bg-opacity-10 dark:bg-opacity-0 dark:hover:bg-opacity-10 transition ease-linear cursor-pointer text-xl"
            @click="searchOpen = !searchOpen">
            <i class="ti ti-search"></i>
        </div>
    @else
        <div x-data @keydown.window.ctrl.k.prevent="searchOpen = true"
            class="mr-4 min-w-80 bg-light-bg-secondary dark:bg-dark-bg-secondary flex items-center justify-between gap-3 py-2 px-4 rounded-lg text-black/40 dark:text-white/40 border border-black/20 dark:border-white/20 cursor-pointer hover:border-blue-400 dark:hover:border-blue-500/50 transition duration-300"
            @click="searchOpen = !searchOpen">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-search cursor-pointer">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                </svg>
                <span class="text-sm">{{ __('navigation/navigation.search.title') }}...</span>
            </div>
            <span class="text-xs">CTRL + K</span>
        </div>
    @endif

    <x-modal open="searchOpen" position="top" class="p-4 md:p-0" :closeIcon="false">
        <div
            class="flex flex-col justify-between w-full max-w-[1280px] max-h-[720px] rounded-xl bg-light-bg-secondary dark:bg-dark-bg-secondary overflow-hidden transition ease-in-out">
            <div class="flex items-center px-4 py-3 border-b border-b-black/20 dark:border-b-white/20">
                <i class="ti ti-search" wire:loading.remove wire:target="query"></i>
                <i class="ti ti-loader animate-spin" wire:loading wire:target="query"></i>
                <input type="text" wire:model.live="query"
                    class="w-full placeholder-neutral-500 bg-transparent border-0 focus:ring-0 focus:outline-none"
                    placeholder="{{ __('navigation/navigation.search.desc') }}" x-ref="searchInput">
            </div>

            <div class="flex flex-col gap-4 min-h-40 p-4 overflow-y-auto max-h-[500px]">
                @if ($results)
                    <!-- Books -->
                    @if (count($results['books']) > 0)
                        <div x-data="{ open: true }">
                            <button @click="open = !open"
                                class="inline-flex justify-between w-full text-left text-lg font-semibold">
                                <span>📚 {{ __('navigation/navigation.search.models.book') }}
                                    ({{ count($results['books']) }})</span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                    class="ml-1 h-4 w-4 transition-transform duration-300 ease-in-out"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:enter-start="opacity-0 -translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-8"
                                class="mt-2 space-y-2 overflow-hidden transform">
                                @foreach ($results['books'] as $book)
                                    <div class="cursor-pointer rounded-lg py-3 px-5 transition hover:bg-neutral-700"
                                        onclick="window.location.href = '{{ route('book.detail', [$book->id, $book->slug]) }}'">
                                        <h3 class="font-semibold">{{ $book->title }}</h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Authors -->
                    @if (count($results['authors']) > 0)
                        <div x-data="{ open: true }">
                            <button @click="open = !open"
                                class="inline-flex justify-between w-full text-left text-lg font-semibold">
                                <span>✍️ {{ __('navigation/navigation.search.models.author') }}
                                    ({{ count($results['authors']) }})</span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                    class="ml-1 h-4 w-4 transition-transform duration-300 ease-in-out"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:enter-start="opacity-0 -translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-8"
                                class="mt-2 space-y-2 overflow-hidden transform">
                                @foreach ($results['authors'] as $author)
                                    <div class="cursor-pointer rounded-lg py-3 px-5 transition hover:bg-neutral-700"
                                        onclick="window.location.href = '{{ route('author.detail', [$author->id, $author->slug]) }}'">
                                        <h3 class="font-semibold">{{ $author->fullname }}</h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Publishers -->
                    @if (count($results['publishers']) > 0)
                        <div x-data="{ open: true }">
                            <button @click="open = !open"
                                class="inline-flex justify-between w-full text-left text-lg font-semibold">
                                <span>🏢 {{ __('navigation/navigation.search.models.publisher') }}
                                    ({{ count($results['publishers']) }})</span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                    class="ml-1 h-4 w-4 transition-transform duration-300 ease-in-out"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:enter-start="opacity-0 -translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-8"
                                class="mt-2 space-y-2 overflow-hidden transform">
                                @foreach ($results['publishers'] as $publisher)
                                    <div class="cursor-pointer rounded-lg py-3 px-5 transition hover:bg-neutral-700"
                                        onclick="window.location.href = '{{ route('publisher.detail', [$publisher->id, $publisher->slug]) }}'">
                                        <h3 class="font-semibold">{{ $publisher->name }}</h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Collections -->
                    @if (count($results['collections']) > 0)
                        <div x-data="{ open: true }">
                            <button @click="open = !open"
                                class="inline-flex justify-between w-full text-left text-lg font-semibold">
                                <span>🔖 {{ __('navigation/navigation.search.models.collection') }}
                                    ({{ count($results['collections']) }})</span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open }"
                                    class="ml-1 h-4 w-4 transition-transform duration-300 ease-in-out"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:enter-start="opacity-0 -translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-8"
                                class="mt-2 space-y-2 overflow-hidden transform">
                                @foreach ($results['collections'] as $collection)
                                    <div class="cursor-pointer rounded-lg py-3 px-5 transition hover:bg-neutral-700"
                                        onclick="window.location.href = '{{ route('collection.detail', $collection->id) }}'">
                                        <h3 class="font-semibold">{{ $collection->title }}</h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @elseif ($query != '' && strlen($query) > 2 && count($results) == 0)
                    <div class="flex justify-center my-auto" wire:loading.remove wire:target="query">
                        <p class="text-neutral-500">
                            {{ __('navigation/navigation.search.no_results') }}
                            "{{ $query }}"</p>
                    </div>
                @elseif(strlen($query) == 0)
                    <div class="flex justify-center my-auto">
                        <p wire:loading.remove wire:target="query" class="text-neutral-500">
                            {{ __('navigation/navigation.search.no_recent') }}</p>
                        <p wire:loading wire:target="query" class="text-neutral-500">
                            {{ __('navigation/navigation.loading') }}...</p>
                    </div>
                @endif
            </div>

            <div
                class="hidden md:flex items-center gap-2 p-4 text-xs text-gray-500 rounded-b-xl border-t border-t-black/20 dark:border-t-white/20">
                <kbd
                    class="inline-block size-min whitespace-nowrap rounded-md border border-neutral-300 bg-neutral-50 px-2 py-1 font-mono text-xs font-semibold text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">Esc</kbd>
                <span>{{ __('navigation/navigation.search.to_close') }}</span>
            </div>
        </div>
    </x-modal>
</div>
