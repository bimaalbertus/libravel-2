@php
    $features = [
        'search_books' => [
            'icon' => '<i class="ti ti-file-search"></i>',
            'image' => '/assets/wireframe-1.webp',
            'hover' => 'hover:bg-[#3CA1FE]/70',
            'title' => __('navigation/features.search_books.title'),
            'description' => __('navigation/features.search_books.description'),
        ],
        'download_books' => [
            'icon' => '<i class="ti ti-download"></i>',
            'image' => '/assets/wireframe-4.webp',
            'hover' => 'hover:bg-[#FF6A6A]/70',
            'title' => __('navigation/features.download_books.title'),
            'description' => __('navigation/features.download_books.description'),
        ],
        'manage_collection' => [
            'icon' => '<i class="ti ti-bookmark"></i>',
            'image' => '/assets/wireframe-2.webp',
            'hover' => 'hover:bg-[#4DE9CB]',
            'title' => __('navigation/features.manage_collection.title'),
            'description' => __('navigation/features.manage_collection.description'),
        ],
        'manage_account' => [
            'icon' => '<i class="ti ti-user-cog"></i>',
            'image' => '/assets/wireframe-3.webp',
            'hover' => 'hover:bg-[#FE8CFB]',
            'title' => __('navigation/features.manage_account.title'),
            'description' => __('navigation/features.manage_account.description'),
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
    @vite(['resources/css/app.css'])

    <style>
        .pause-animation {
            animation-play-state: paused !important;
        }
    </style>
</head>

<body class="bg-[#F1F5F9] dark:bg-[#030806] text-[#222222] dark:text-[#fff] scroll-smooth">

    <nav x-data="{
        showNavbar: true,
        lastScrollPosition: 0,
        scrollDistance: 0,
        init() {
            window.addEventListener('scroll', () => {
                const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    
                if (currentScrollPosition < 0) {
                    return;
                }
    
                if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 20) {
                    return;
                }
    
                this.showNavbar = currentScrollPosition < this.lastScrollPosition;
                this.lastScrollPosition = currentScrollPosition;
            });
        }
    }" :class="showNavbar ? 'translate-y-0 scale-100' : '-translate-y-32 scale-95'"
        class="fixed mx-auto top-5 md:top-10 left-0 right-0 w-full max-w-md md:max-w-7xl flex items-center justify-between p-3 md:p-1 font-euclid-circular-b z-[999] rounded-2xl bg-[#FDF6F0]/80 backdrop-blur-sm dark:bg-dark-bg-secondary hover:shadow-xl transition-all duration-300 ease-initial">

        <div class="flex lg:flex-row md:pl-6 items-center gap-6 justify-between">
            <a href="/" class="hover:scale-105 transition ease-in-out">
                <x-logo />
            </a>

            <ul x-data="{ open: false }" class="hidden md:flex gap-4 text-[13px] font-manrope font-semibold">
                <li
                    class="relative h-full grid text-dark-bg dark:text-light-bg hover:bg-[#554D34]/10 dark:hover:bg-dark-btn-primary/10 px-4 py-2 rounded-lg transition duration-200 ease-in-out cursor-pointer">
                    {{ __('navigation/navigation.home') }}</li>

                <div @mouseleave="open = false" class="relative">
                    <button @click="open = !open" @click.outside="open = false" @mouseover="open = true"
                        class="flex items-center text-dark-bg dark:text-light-bg hover:bg-[#554D34]/10 dark:hover:bg-dark-btn-primary/10 px-4 py-2 rounded-lg transition duration-300 ease-in-out">
                        <span>{{ __('navigation/navigation.browse.title') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': open === true }"
                            class="ml-1 h-4 w-4 transition ease-in-out" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-cloak
                        x-transition:enter="transition ease-linear duration-100 delay-100 motion-reduce:transition-opacity"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100 motion-reduce:transition-opacity"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-8" class="absolute -left-5">
                        <div
                            class="w-[40rem] p-4 mt-7 space-y-3 rounded-lg bg-[#FDF6F0] dark:bg-dark-bg-secondary shadow-xl ring-1 ring-black ring-opacity-5">
                            <span
                                class="uppercase tracking-wider text-[11px] text-neutral-400">{{ __('navigation/navigation.browse.subtitle') }}</span>
                            <div class="grid xl:grid-cols-2 gap-4">
                                <a href="/browse/subject">
                                    <div
                                        class="flex items-center gap-2 w-full hover:bg-neutral-400/20 p-2 rounded-lg transition ease-linear group">
                                        <span
                                            class="inline-flex items-center bg-dark-bg/10 group-hover:bg-light-secondary dark:group-hover:bg-dark-btn-primary group-hover:text-white p-2 rounded-full text-xl transition ease-in">
                                            <i class="ti ti-bulb"></i>
                                        </span>
                                        <div>
                                            <span
                                                class="font-bold">{{ __('navigation/navigation.browse.subject.label') }}</span>
                                            <p class="text-neutral-400">
                                                {{ __('navigation/navigation.browse.subject.desc') }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="/browse/trending">
                                    <div
                                        class="flex items-center gap-2 w-full hover:bg-neutral-400/20 p-2 rounded-lg transition ease-linear group">
                                        <span
                                            class="inline-flex items-center bg-dark-bg/10 group-hover:bg-light-secondary dark:group-hover:bg-dark-btn-primary group-hover:text-white p-2 rounded-full text-xl transition ease-in">
                                            <i class="ti ti-flame"></i>
                                        </span>
                                        <div>
                                            <span
                                                class="font-bold">{{ __('navigation/navigation.browse.trending.label') }}</span>
                                            <p class="text-neutral-400">
                                                {{ __('navigation/navigation.browse.trending.desc') }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="/browse/random">
                                    <div
                                        class="flex items-center gap-2 w-full hover:bg-neutral-400/20 p-2 rounded-lg transition ease-linear group">
                                        <span
                                            class="inline-flex items-center bg-dark-bg/10 group-hover:bg-light-secondary dark:group-hover:bg-dark-btn-primary group-hover:text-white p-2 rounded-full text-xl transition ease-in">
                                            <i class="ti ti-dice-6"></i>
                                        </span>
                                        <div>
                                            <span
                                                class="font-bold">{{ __('navigation/navigation.browse.random_books.label') }}</span>
                                            <p class="text-neutral-400">
                                                {{ __('navigation/navigation.browse.random_books.desc') }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="/browse/genre">
                                    <div
                                        class="flex items-center gap-2 w-full hover:bg-neutral-400/20 p-2 rounded-lg transition ease-linear group">
                                        <span
                                            class="inline-flex items-center bg-dark-bg/10 group-hover:bg-light-secondary dark:group-hover:bg-dark-btn-primary group-hover:text-white p-2 rounded-full text-xl transition ease-in">
                                            <i class="ti ti-tags"></i>
                                        </span>
                                        <div>
                                            <span
                                                class="font-bold">{{ __('navigation/navigation.browse.genre.label') }}</span>
                                            <p class="text-neutral-400">
                                                {{ __('navigation/navigation.browse.genre.desc') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <li
                    class="relative h-full grid text-dark-bg dark:text-light-bg hover:bg-[#554D34]/10 dark:hover:bg-dark-btn-primary/10 px-4 py-2 rounded-lg transition duration-200 ease-in-out cursor-pointer">
                    {{ __('navigation/navigation.about') }}</li>
            </ul>
        </div>

        <div class="flex items-center gap-2">
            <x-theme-toggle type="icon" />

            <x-animated-button route="/auth/login" name="{{ __('pages/login.title') }}" icon="ti-login-2" />
        </div>
    </nav>

    <main class="font-euclid-circular-b bg-[#7A5D3F]">
        <div class="gradient-bg h-screen">
            <div class="flex px-4 md:px-8 py-32">
                <section class="mt-48 flex flex-col items-center justify-center mx-auto">
                    <div class="flex flex-col items-center gap-10 space-y-0 text-center">
                        <h1
                            class="text-[11rem] text-white font-lovan font-medium leading-[38px] md:leading-[100%] lg:leading-[80px]">
                            Find Some Book
                        </h1>
                        <span class="font-geist-sans text-3xl font-semibold text-white">Search it, read it, download
                            it.</span>
                        <x-animated-button route="/auth/login" class="active:scale-90 transition-transform ease-linear"
                            name="Get started" bgColor="bg-white dark:bg-dark-bg-tertiary"
                            textColor="text-black dark:text-white" fontSize="text-lg"
                            translateValue="group-hover:translate-x-28" containerWidth="w-40" containerHeight="h-12"
                            iconBgColor="bg-dark-bg-tertiary dark:bg-light-bg-primary size-12"
                            iconTextColor="text-white dark:text-black" fontWeight="medium" icon="ti-login-2" />
                    </div>
                </section>
            </div>
        </div>

        <div class="bg-[#f7ede4] dark:bg-[#101110] rounded-[3rem] flex flex-col">
            <div class="bg-dark-gradient p-8 md:p-16">
                <h1
                    class="text-4xl md:text-8xl font-bold font-geist-sans text-light-text-primary dark:text-dark-text-primary">
                    {{ __('navigation/features.title.description') }}.</h1>

                <div class="mt-8 grid items-start grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($features as $feature)
                        <div
                            class="bg-white shadow-xl relative group/card dark:bg-white/[0.03] w-auto min-h-56 h-full rounded-3xl p-6 transition duration-300 backdrop-blur-sm">
                            <div class="flex flex-col gap-4">
                                <div
                                    class="relative overflow-hidden w-full h-52 {{ $feature['hover'] }} block dark:hidden bg-light-bg-secondary p-4 rounded-2xl transition-all ease-linear group/image">
                                    <img src="{{ $feature['image'] }}" alt="{{ $feature['title'] }}"
                                        class="absolute -bottom-10 -right-16 overflow-visible scale-110 transition-all ease-linear group-hover/image:scale-[1.15] origin-bottom-right">
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center justify-center bg-fuchsia-700/20 size-10 p-2 rounded-full text-pink-500 text-3xl">
                                        {!! $feature['icon'] !!}
                                    </span>
                                    <h1 class="font-bold text-2xl font-geist-sans">
                                        {{ $feature['title'] }}
                                    </h1>
                                </div>
                                <p class="font-figtree text-black dark:text-white">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    </d>
                </div>
            </div>

            <div class="flex items-center justify-center mt-48 p-8 md:p-16">
                <div x-data="{ isHovered: false }" x-init="$nextTick(() => {
                    let ul = $refs.logos;
                    ul.insertAdjacentHTML('afterend', ul.outerHTML);
                    ul.nextSibling.setAttribute('aria-hidden', 'true');
                })" @mouseenter="isHovered = true"
                    @mouseleave="isHovered = false"
                    class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                    <ul x-ref="logos"
                        class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
                        :class="{ 'pause-animation': isHovered }">
                        @foreach (\App\Models\Book::orderBy('title')->paginate(5) as $book)
                            <li>
                                <img src="{{ $book->cover_path }}" alt="{{ $book->title }}" loading="lazy"
                                    class="w-48 h-72 object-cover rounded-xl shadow-md">
                            </li>
                        @endforeach
                    </ul>
                    <ul class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
                        :class="{ 'pause-animation': isHovered }">
                        @foreach (\App\Models\Book::orderByDesc('title')->paginate(5) as $book)
                            <li>
                                <img src="{{ $book->cover_path }}" alt="{{ $book->title }}" loading="lazy"
                                    class="w-48 h-72 object-cover rounded-xl shadow-md">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
