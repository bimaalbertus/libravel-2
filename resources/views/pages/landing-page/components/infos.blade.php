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

    $covers = [
        'harry-potter-and-the-sorcerers-stone' => [
            'path' => 'https://m.media-amazon.com/images/I/91NjWLufnNL._AC_UF1000,1000_QL80_.jpg',
            'slug' => 'harry-potter-and-the-sorcerers-stone',
        ],
        '1984' => [
            'path' => 'https://m.media-amazon.com/images/I/61ZewDE3beL._AC_UF894,1000_QL80_.jpg',
            'slug' => '1984',
        ],
        'murder-on-the-orient-express' => [
            'path' => 'https://m.media-amazon.com/images/I/71ihbKf67RL.jpg',
            'slug' => 'murder-on-the-orient-express',
        ],
        'war-and-peace' => [
            'path' => 'https://m.media-amazon.com/images/I/81W6BFaJJWL.jpg',
            'slug' => 'war-and-peace',
        ],
        'the-hobbit' => [
            'path' => 'https://m.media-amazon.com/images/I/712cDO7d73L._AC_UF1000,1000_QL80_.jpg',
            'slug' => 'the-hobbit',
        ],
        'pride-and-prejudice' => [
            'path' => 'https://m.media-amazon.com/images/I/712P0p5cXIL._AC_UF1000,1000_QL80_.jpg',
            'slug' => 'pride-and-prejudice',
        ],
    ];
@endphp

@push('script')
    <style>
        .pause-animation {
            animation-play-state: paused !important;
        }
    </style>
@endpush

<div class="bg-[#f7ede4] dark:bg-[#101110] rounded-[3rem] flex flex-col">
    <div class="bg-dark-gradient p-8 md:p-16">
        <h1 class="text-4xl md:text-8xl font-bold font-geist-sans text-light-text-primary dark:text-dark-text-primary">
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

    <div class="flex flex-col items-center justify-center gap-8 md:gap-16 mt-32 p-8 md:p-16">
        <h1 class="text-4xl md:text-7xl font-bold font-geist-sans text-light-text-primary dark:text-dark-text-primary">
            {{ __('navigation/navigation.jumbotron.find_your_own') }}.</h1>
        <div x-data="{ isHovered: false }" x-init="$nextTick(() => {
            let ul = $refs.logos;
            ul.insertAdjacentHTML('afterend', ul.outerHTML);
            ul.nextSibling.setAttribute('aria-hidden', 'true');
        })" @mouseenter="isHovered = true"
            @mouseleave="isHovered = false"
            class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
            <ul x-ref="logos"
                class="flex items-center justify-center md:justify-start [&_li]:mx-2 md:[&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
                :class="{ 'pause-animation': isHovered }">
                @foreach ($covers as $book)
                    <li>
                        <img src="{{ $book['path'] }}" alt="{{ $book['slug'] }}" loading="lazy"
                            class="w-24 h-40 md:w-48 md:h-72 object-cover rounded-xl shadow-md">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
