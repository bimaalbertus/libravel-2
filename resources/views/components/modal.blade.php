@props([
    'open' => 'isOpen',
    'position' => 'center',
    'blur' => 'md',
    'closeIcon' => true,
    'maxWidth' => '2xl',
    'closeOnEsc' => true,
    'closeOnClickOutside' => true,
    'preventScroll' => true,
    'zIndex' => 30,
    'type' => 'classic',

    'title' => 'Modal Title',
    'body' => 'Modal Body Content',
    'header' => true,
    'footer' => true,
])

@php
    $positions = [
        'top' => 'top-[5rem] items-start',
        'center' => 'items-center',
        'bottom' => 'bottom-0 items-end',
    ];

    $maxWidths = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        'full' => 'sm:max-w-full',
    ];

    $blurs = [
        'none' => 'backdrop-blur-none',
        'sm' => 'backdrop-blur-sm',
        'md' => 'backdrop-blur-md',
        'lg' => 'backdrop-blur-lg',
        'xl' => 'backdrop-blur-xl',
        '2xl' => 'backdrop-blur-2xl',
    ];

    $positionClass = $positions[$position] ?? $positions['center'];
    $maxWidthClass = $maxWidths[$maxWidth] ?? $maxWidths['2xl'];
    $blurClass = $blurs[$blur] ?? $blurs['md'];

    $enterStartClass = match ($position) {
        'bottom' => 'translate-y-4',
        'top' => '-translate-y-4',
        default => 'scale-95',
    };

    $leaveEndClass = $enterStartClass;

    $zIndexBase = $zIndex;
    $zIndexBackdrop = $zIndexBase - 10;
    $zIndexContent = $zIndexBase;
    $zIndexClose = $zIndexBase + 10;
@endphp

@switch($type)
    @case('new')
        <div x-cloak x-show="{{ $open }}" x-transition.opacity.duration.200ms x-trap.inert.noscroll="{{ $open }}"
            x-on:keydown.esc.window="{{ $open }} = false" x-on:click.self="{{ $open }} = false"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8">
            <!-- Modal Dialog -->
            <div x-show="{{ $open }}"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-110" x-transition:enter-end="opacity-100 scale-100"
                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-lg bg-light-bg-secondary dark:bg-dark-bg-secondary border border-black/40 dark:border-white/40">

                <!-- Dialog Header (Optional) -->
                @if ($header)
                    <div
                        class="flex items-center justify-between border-b border-black/40 bg-light-bg/60 p-4 dark:border-white/40 dark:bg-dark-bg/20">
                        <h3 class="font-semibold tracking-wide text-on-surface-strong dark:text-on-surface-dark-strong">
                            {{ $title }}</h3>
                        <button x-on:click="{{ $open }} = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                                fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Dialog Body -->
                <div class="p-4 sm:flex sm:items-start">
                    <div class="mt-3 w-full">
                        {{ $body }}
                    </div>
                </div>

                <!-- Dialog Footer (Optional) -->
                @if ($footer)
                    <div class="border-t border-black/40 p-4 dark:border-white/40 mt-5 flex gap-2 justify-end">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    @break

    @default
        <div x-init="$watch('{{ $open }}', value => { document.body.classList.toggle('overflow-hidden', value) })" x-show="{{ $open }}" x-cloak {!! $attributes->merge(['class' => "fixed inset-0 flex justify-center $positionClass"]) !!}
            style="z-index: {{ $zIndexBase }}" @if ($closeOnEsc)
            @keydown.escape.window="{{ $open }} = false"
            @endif
            >
            {{-- Backdrop --}}
            <div x-show="{{ $open }}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @if ($closeOnClickOutside) @click="{{ $open }} = false" @endif
                class="fixed inset-0 bg-neutral-500/75 dark:bg-neutral-900/75 {{ $blurClass }}"
                style="z-index: {{ $zIndexBackdrop }}"></div>

            {{-- Close Icon --}}
            @if ($closeIcon)
                <button @click="{{ $open }} = false"
                    class="absolute right-4 top-4 text-neutral-400 hover:text-neutral-500 dark:text-neutral-500 dark:hover:text-neutral-400 transition-colors"
                    style="z-index: {{ $zIndexClose }}">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif

            {{-- Modal Content --}}
            <div x-show="{{ $open }}" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 {{ $enterStartClass }}"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 {{ $leaveEndClass }}"
                class="relative w-full {{ $maxWidthClass }} overflow-y-auto" style="z-index: {{ $zIndexContent }}">
                {{ $slot }}
            </div>
        </div>
@endswitch
