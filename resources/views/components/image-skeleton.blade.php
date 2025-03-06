@props([
    'src' => '',
    'alt' => '',
    'width' => null,
    'height' => null,
    'placeholder' =>
        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMDAgMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2NjYyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmaWxsPSIjNjY2IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjMzZW0iPkxvYWRpbmc8L3RleHQ+PC9zdmc+',
])
<div x-data="lazyImage('{{ $src }}', '{{ $placeholder }}')" x-init="init()" class="relative overflow-hidden">
    <img x-ref="image" x-bind:src="currentSrc" alt="{{ $alt }}"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
        class="transition-opacity duration-300 {{ $attributes->get('class', 'w-full h-auto') }}"
        :class="{ 'opacity-0': isLoading, 'opacity-100': !isLoading }" />
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('lazyImage', (src, placeholder) => ({
                    currentSrc: placeholder,
                    isLoading: true,
                    init() {
                        const img = new Image();
                        img.src = src;
                        img.onload = () => {
                            this.currentSrc = src;
                            this.isLoading = false;
                        };
                    }
                }));
            });
        </script>
    @endpush
@endonce
