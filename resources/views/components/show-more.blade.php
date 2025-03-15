<!-- resources/views/components/show-more-text.blade.php -->
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
    $parsedown = new Parsedown();
    $htmlText = $parsedown->text($text);

    $htmlText = str($htmlText)->sanitizeHtml();
@endphp

<div x-data="{
    isExpanded: @js($expanded),
    fullText: @js($htmlText),
    truncatedText: null,
    init() {
        this.truncatedText = this.fullText.length > {{ $limit }} ?
            this.fullText.substring(0, {{ $limit }}) + '...' :
            this.fullText;
    },
    toggle() {
        this.isExpanded = !this.isExpanded;
    }
}" {{ $attributes->merge(['class' => 'relative w-full']) }}>
    <div x-show="true" x-transition:enter="transition ease-out duration-{{ $animationDuration }}"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="{{ $textClass }} flex flex-col prose prose-light dark:prose-dark">
        <span x-html="isExpanded ? fullText : truncatedText"></span>

        @if (strlen($text) > $limit)
            <button x-show="fullText.length > {{ $limit }}" @click="toggle()"
                class="{{ $buttonClass }} inline-flex items-center gap-1">
                <span x-text="isExpanded ? '{{ $lessText }}' : '{{ $moreText }}'"
                    class="{{ $buttonClass }}"></span>
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
