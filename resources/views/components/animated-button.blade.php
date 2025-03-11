@props([
    'name' => '',
    'icon' => 'ti-login-2',
    'bgColor' => 'bg-[#554D34] dark:bg-dark-primary',
    'textColor' => 'text-white',
    'fontWeight' => 'semibold',
    'iconBgColor' => 'bg-[#F1F5F9]',
    'iconTextColor' => 'text-[#1f1f1f]',
    'buttonWidth' => 'w-auto',
    'containerWidth' => 'w-20',
    'containerHeight' => 'h-8',
    'padding' => 'py-1 pl-1 pr-2',
    'hoverPadding' => 'hover:pl-2 hover:pr-1',
    'translateValue' => 'group-hover:translate-x-12',
    'reverseTranslateValue' => '-translate-x-full group-hover:translate-x-0',
    'rounded' => 'rounded-xl',
    'containerRounded' => 'rounded-lg',
    'fontSize' => 'text-xs',
    'href' => '',
    'target' => '_self',
])

<button @if (strlen($href) > 0) data-href="{{ $href }}" data-target="{{ $target }}" @endif
    {{ $attributes->merge([
        'class' => "flex items-center overflow-hidden capitalize {$fontSize} font-{$fontWeight} {$bgColor} {$textColor} {$padding} {$hoverPadding} {$rounded} hover:shadow-xl group {$buttonWidth}",
    ]) }}>
    <!-- Container with fixed width to maintain button size -->
    <div class="relative {{ $containerWidth }} {{ $containerHeight }} overflow-hidden {{ $containerRounded }}">
        <!-- Initial visible content -->
        <div
            class="absolute inset-0 flex items-center gap-2 transform transition-transform duration-300 ease-in-out {{ $translateValue }}">
            <span
                class="inline-flex items-center justify-center text-2xl {{ $iconTextColor }} {{ $iconBgColor }} p-1 {{ $containerRounded }}">
                <i class="ti {{ $icon }}"></i>
            </span>
            <span class="text-center">{{ $name }}</span>
        </div>

        <!-- Content that appears on hover -->
        <div
            class="absolute inset-0 flex items-center gap-2 transform {{ $reverseTranslateValue }} transition-transform duration-300 ease-in-out">
            <span class="text-center">{{ $name }}</span>
        </div>
    </div>

    {{ $slot ?? '' }}
</button>
