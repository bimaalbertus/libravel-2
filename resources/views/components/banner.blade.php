@php
    $banners = \App\Models\Banner::where('is_active', true)->get();
@endphp

@if ($banners->count() > 0)
    <div x-data="carousel({{ $banners->count() }})" x-init="init()" @mouseover="pauseAutoplay()" @mouseleave="resumeAutoplay()"
        class="relative w-full min-h-[540px] h-[40rem] md:h-[540px] group">
        @foreach ($banners as $index => $banner)
            <div x-show="currentIndex === {{ $index }}" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full flex items-center justify-center bg-cover bg-center bg-no-repeat rounded-2xl"
                style='background-image: linear-gradient(transparent 0%, rgba(0, 0, 0) 100%), url("{{ $banner->getFirstMediaUrl('banners') ?? 'https://placehold.co/1280x720?text=No+Image+Available' }}");'
                x-cloak>
                @if ($banner->content)
                    <div class="flex flex-col gap-2 absolute left-0 bottom-8 px-8 text-white"
                        x-transition:enter="transition-opacity ease-out duration-500"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-in duration-500"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <h1 class="text-2xl md:text-6xl font-bold uppercase font-subjectivity">
                            {{ Str::limit($banner->title, 100) }}
                        </h1>
                        <p class="text-md max-w-3xl text-justify">{!! $banner->content !!}</p>
                    </div>
                @endif
            </div>
        @endforeach

        @if ($banners->count() > 1)
            <div
                class="hidden md:flex absolute top-1/2 -left-9 -right-9 z-10 justify-between px-4 transform -translate-y-1/2">
                <button @click="prev()"
                    class="opacity-0 group-hover:opacity-100 transition-opacity bg-light-bg dark:bg-dark-bg rounded-full p-2">
                    <svg width="30" height="30" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.84182 3.13514C9.04327 3.32401 9.05348 3.64042 8.86462 3.84188L5.43521 7.49991L8.86462 11.1579C9.05348 11.3594 9.04327 11.6758 8.84182 11.8647C8.64036 12.0535 8.32394 12.0433 8.13508 11.8419L4.38508 7.84188C4.20477 7.64955 4.20477 7.35027 4.38508 7.15794L8.13508 3.15794C8.32394 2.95648 8.64036 2.94628 8.84182 3.13514Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <button @click="next()"
                    class="opacity-0 group-hover:opacity-100 transition-opacity bg-light-bg dark:bg-dark-bg rounded-full p-2">
                    <svg width="30" height="30" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.1584 3.13508C6.35985 2.94621 6.67627 2.95642 6.86514 3.15788L10.6151 7.15788C10.7954 7.3502 10.7954 7.64949 10.6151 7.84182L6.86514 11.8418C6.67627 12.0433 6.35985 12.0535 6.1584 11.8646C5.95694 11.6757 5.94673 11.3593 6.1356 11.1579L9.565 7.49985L6.1356 3.84182C5.94673 3.64036 5.95694 3.32394 6.1584 3.13508Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="flex md:hidden absolute bottom-5 right-5 z-10 justify-between px-4 space-x-2">
                <button @click="prev()"
                    class="opacity-0 group-hover:opacity-100 transition-opacity bg-light-bg dark:bg-dark-bg rounded-full p-2">
                    <svg width="30" height="30" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.84182 3.13514C9.04327 3.32401 9.05348 3.64042 8.86462 3.84188L5.43521 7.49991L8.86462 11.1579C9.05348 11.3594 9.04327 11.6758 8.84182 11.8647C8.64036 12.0535 8.32394 12.0433 8.13508 11.8419L4.38508 7.84188C4.20477 7.64955 4.20477 7.35027 4.38508 7.15794L8.13508 3.15794C8.32394 2.95648 8.64036 2.94628 8.84182 3.13514Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <button @click="next()"
                    class="opacity-0 group-hover:opacity-100 transition-opacity bg-light-bg dark:bg-dark-bg rounded-full p-2">
                    <svg width="30" height="30" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.1584 3.13508C6.35985 2.94621 6.67627 2.95642 6.86514 3.15788L10.6151 7.15788C10.7954 7.3502 10.7954 7.64949 10.6151 7.84182L6.86514 11.8418C6.67627 12.0433 6.35985 12.0535 6.1584 11.8646C5.95694 11.6757 5.94673 11.3593 6.1356 11.1579L9.565 7.49985L6.1356 3.84182C5.94673 3.64036 5.95694 3.32394 6.1584 3.13508Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="absolute bottom-2 left-2 flex space-x-1">
                @foreach ($banners as $index => $banner)
                    <div @click="goTo({{ $index }})" class="size-2 rounded-full cursor-pointer"
                        :class="currentIndex === {{ $index }} ? 'bg-white' : 'bg-stone-400'"></div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function carousel(totalSlides) {
            return {
                currentIndex: 0,
                autoplayInterval: null,
                autoplay: true,
                init() {
                    if (this.autoplay) {
                        this.startAutoplay();
                    }
                },
                startAutoplay(interval = 3000) {
                    this.stopAutoplay();
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, interval);
                },
                stopAutoplay() {
                    if (this.autoplayInterval) {
                        clearInterval(this.autoplayInterval);
                    }
                },
                pauseAutoplay() {
                    this.stopAutoplay();
                },
                resumeAutoplay() {
                    if (this.autoplay) {
                        this.startAutoplay();
                    }
                },
                next() {
                    this.currentIndex =
                        this.currentIndex === totalSlides - 1 ?
                        0 :
                        this.currentIndex + 1;
                },
                prev() {
                    this.currentIndex =
                        this.currentIndex === 0 ?
                        totalSlides - 1 :
                        this.currentIndex - 1;
                },
                goTo(index) {
                    this.currentIndex = index;
                }
            }
        }
    </script>
@endif
