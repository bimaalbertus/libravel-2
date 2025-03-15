@props([
    'text' => '',
    'limit' => 150,
    'expanded' => false,
    'moreText' => __('navigation/navigation.show_more'),
    'lessText' => __('navigation/navigation.show_less'),
    'textClass' => 'text-gray-700 dark:text-gray-300',
    'buttonClass' =>
        'text-blue-600 dark:text-blue-400 font-medium hover:underline focus:outline-none transition-colors',
    'fadeEffect' => true,
    'animationDuration' => 300,
])

@php

    $htmlText = Illuminate\Support\Str::markdown($text);

    $plainText = strip_tags($htmlText);
    $truncatedPlainText = Str::limit($plainText, $limit);

    $truncatedHtml = strlen($plainText) > $limit ? '<span>' . $truncatedPlainText . '</span>' : $htmlText;
@endphp

<div x-data="{
    isExpanded: @js($expanded),
    fullHtml: @js($htmlText),
    truncatedHtml: @js($truncatedHtml),
}" {{ $attributes->merge(['class' => 'relative w-full']) }}>
    <div x-show="true" x-transition:enter="transition ease-out duration-{{ $animationDuration }}"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="{{ $textClass }} flex flex-col">
        <div x-html="isExpanded ? fullHtml : truncatedHtml"></div>

        @if (strlen($plainText) > $limit)
            <button x-show="true" @click="isExpanded = !isExpanded"
                class="{{ $buttonClass }} inline-flex items-center gap-1">
                <span x-text="isExpanded ? '{!! $lessText !!}' : '{!! $moreText !!}'"></span>
                <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': isExpanded }"
                    class=" h-4 w-4 transition ease-in-out" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>
</div>
