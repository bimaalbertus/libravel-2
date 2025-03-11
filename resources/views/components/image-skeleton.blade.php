@props([
    'width' => 'w-full',
    'height' => 'h-full',
])

<div x-data="{ loaded: false }" class="relative">
    <!-- Skeleton Loader -->
    <div x-show="!loaded"
        class="relative flex {{ $width }} {{ $height }} items-center justify-center rounded-2xl bg-neutral-50 motion-safe:animate-pulse dark:bg-neutral-900"
        aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
            class="size-12 fill-neutral-600/10 dark:fill-neutral-300/10">
            <path fill-rule="evenodd"
                d="M1 5.25A2.25 2.25 0 0 1 3.25 3h13.5A2.25 2.25 0 0 1 19 5.25v9.5A2.25 2.25 0 0 1 16.75 17H3.25A2.25 2.25 0 0 1 1 14.75v-9.5Zm1.5 5.81v3.69c0 .414.336.75.75.75h13.5a.75.75 0 0 0 .75-.75v-2.69l-2.22-2.219a.75.75 0 0 0-1.06 0l-1.91 1.909.47.47a.75.75 0 1 1-1.06 1.06L6.53 8.091a.75.75 0 0 0-1.06 0l-2.97 2.97ZM12 7a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"
                clip-rule="evenodd" />
        </svg>
    </div>

    <!-- Image Element -->
    <img :class="{ 'hidden': !loaded }" x-ref="imageElement" x-init="if ($refs.imageElement.complete) {
        loaded = true;
    } else {
        $refs.imageElement.addEventListener('load', () => loaded = true);
        $refs.imageElement.addEventListener('error', () => loaded = false);
    }"
        {{ $attributes->merge(['src', 'alt', 'class']) }} />

    <!-- Screen Reader Text for Accessibility -->
    <span class="sr-only">loading</span>
</div>
