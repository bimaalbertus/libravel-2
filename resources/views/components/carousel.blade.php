{{-- resources/views/components/carousel-slide.blade.php --}}
@props(['active' => false])

<div {{ $attributes->merge(['class' => 'relative flex-shrink-0 transition-all duration-300 transform origin-center']) }}
    x-bind:class="{
        'scale-100 opacity-100': activeSlide <= $el.dataset.index && $el.dataset.index < activeSlide +
            currentSlidesToShow,
        'scale-95 opacity-60': activeSlide > $el.dataset.index || $el.dataset.index >= activeSlide + currentSlidesToShow
    }"
    x-bind:style="`width: calc(${100 / currentSlidesToShow}% - ${gap * 0.25 * (currentSlidesToShow - 1) / currentSlidesToShow}rem);`"
    data-index="{{ $attributes['data-index'] ?? 0 }}">

    <div class="h-full transition-all duration-300 transform rounded-lg shadow-lg hover:scale-105">
        {{ $slot }}
    </div>
</div>
