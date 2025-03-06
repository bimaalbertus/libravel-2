@props([
    'bgColor' => 'bg-dark-bg-primary dark:bg-light-bg-primary',
    'hoverColor' => 'hover:bg-opacity-80 dark:hover:bg-opacity-80',
    'textColor' => 'text-white dark:text-black',
    'width' => 'w-16',
    'height' => 'h-8',
    'loading' => false,
    'href' => '',
    'target' => '_self',
])

<button @if (strlen($href) > 0) data-href="{{ $href }}" data-target="{{ $target }}" @endif
    {{ $attributes->merge([
        'type' => 'button',
        'class' => "inline-flex items-center justify-center {$width} {$height} shadow-sm rounded-lg {$bgColor} {$hoverColor} transition-all duration-300 {$textColor} text-base font-medium font-figtree leading-7",
    ]) }}
    {{ $loading ? 'wire:loading.class=opacity-80 cursor-not-allowed' : '' }} {{ $attributes->only('wire:target') }}>
    <span class="text-sm" @if ($loading) wire:loading.remove @endif
        {{ $attributes->only('wire:target') }}>
        {{ $slot }}
    </span>
    @if ($loading)
        <span wire:loading {{ $attributes->only('wire:target') }} class="flex items-center gap-2">
            <i class="ti ti-loader animate-spin"></i>
        </span>
    @endif
</button>
