@props([
    'url' => '',
    'previewImage' => $imageSrc ?? '',
    'width' => 200,
    'height' => 125,
    'class' => '',
])

<div x-data="{
    isOpen: false,
    translateX: 0,
    translateY: 20,
    scale: 0.6,
    opacity: 0,
    springConfig: {
        duration: 600,
        easing: 'cubic-bezier(0.23, 1, 0.32, 1)'
    },
    handleMouseMove(event) {
        const targetRect = event.target.getBoundingClientRect();
        const eventOffsetX = event.clientX - targetRect.left;
        const offsetFromCenter = (eventOffsetX - targetRect.width / 2) / 2;
        this.translateX = offsetFromCenter;
    },
    animateIn() {
        this.isOpen = true;
        this.opacity = 1;
        this.translateY = 0;
        this.scale = 1;
    },
    animateOut() {
        this.opacity = 0;
        this.translateY = 20;
        this.scale = 0.6;
        setTimeout(() => {
            this.isOpen = false;
        }, 200);
    }
}" @mouseleave="animateOut()" class="inline-block">
    <a href="{{ $url }}" target="_blank" @mouseover="animateIn()" @mousemove="handleMouseMove"
        class="text-black dark:text-white {{ $class }}">
        {{ $slot }}
    </a>

    <div x-show="isOpen" x-cloak class="absolute z-50 cursor-pointer" @mousemove="handleMouseMove"
        :style="{
            transform: `translateX(${translateX}px) translateY(-100%) translateY(-10px) scale(${scale})`,
            opacity: opacity,
            transition: `all ${springConfig.duration}ms ${springConfig.easing}`
        }">
        <div class="mb-6">
            <a href="{{ $url }}" target="_blank"
                class="block p-1 bg-white border-2 border-transparent shadow-xl rounded-xl hover:border-neutral-200 dark:hover:border-neutral-800 dark:bg-dark-bg-primary transform-gpu">
                <img src="{{ $previewImage ?: 'https://api.microlink.io/?url=' . urlencode($url) . '&screenshot=true&meta=false&embed=screenshot.url&colorScheme=dark&viewport.isMobile=true&viewport.deviceScaleFactor=1&viewport.width=' . $width * 3 . '&viewport.height=' . $height * 3 }}"
                    width="{{ $width }}" height="{{ $height }}"
                    class="rounded-lg w-[{{ $width }}px] h-[{{ $height }}px] object-cover" loading="lazy"
                    alt="">
            </a>
        </div>
    </div>
</div>
