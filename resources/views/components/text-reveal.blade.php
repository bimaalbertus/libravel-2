@props([
    'text' => 'Text Reveal Animation 💫',
    'textClass' => 'text-2xl font-bold leading-6 text-white',
    'delayBetweenChars' => 0.05,
    'initialDelay' => 0.5,
])

<div x-data="{
    text: '{{ $text }}',
    chars: [],
    init() {
        this.chars = Array.from(this.text);
    }
}" class="overflow-hidden {{ $textClass }}">
    <template x-for="(char, index) in chars" :key="index">
        <span class="animate-text-reveal inline-block [animation-fill-mode:backwards]"
            :style="`animation-delay: ${(index * {{ $delayBetweenChars }}) + {{ $initialDelay }}}s`"
            x-text="char === ' ' ? '\u00A0' : char"></span>
    </template>
</div>
