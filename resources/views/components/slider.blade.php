@props([
    'title' => '',
    'datas' => [],
    'model' => 'book',
    'sliderId' => null,
    'slidesToShow' => 5,
    'slidesToScroll' => 3,
    'infinite' => false,
    'speed' => 300,
    'dots' => false,
    'autoplay' => false,
    'responsive' => true,
    'autoplaySpeed' => 3000,
    'arrows' => true,
    'centerMode' => false,
    'centerPadding' => '50px',
    'adaptiveHeight' => false,
    'customPaging' => true,
    'fade' => false,
    'lazyLoad' => 'ondemand',
    'mobileBreakpoint' => 600,
    'tabletBreakpoint' => 1024,
    'desktopBreakpoint' => 1280,
    'mobileSlidesToShow' => 2,
    'mobileSlidesToScroll' => 2,
    'tabletSlidesToShow' => 3,
    'tabletSlidesToScroll' => 3,
    'desktopSlidesToShow' => 4,
    'desktopSlidesToScroll' => 4,
    'thumbnailSize' => 60, // Ukuran thumbnail dalam pixel
    'thumbnailSpacing' => 10, // Jarak antar thumbnail (baru)
    'useThumbDots' => false, // Default tidak menggunakan thumbnail dots
])

@php
    $uniqueSliderId = $sliderId ?? Str::slug($title) . '-' . uniqid();
@endphp

<div class="slick-carousel mb-8" id="slider-container-{{ $uniqueSliderId }}">
    <div class="flex pb-6 pl-4 items-center">
        @if ($title != '')
            <h1 class="font-semibold text-3xl">{{ $title }}</h1>
        @endif

        @if ($arrows)
            <div class="ml-auto text-white text-4xl flex gap-2">
                <button id="prev-btn-{{ $uniqueSliderId }}"
                    class="custom-slick-prev inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
                    aria-label="previous slide">
                    <i class="ti ti-chevron-left"></i>
                </button>
                <button id="next-btn-{{ $uniqueSliderId }}"
                    class="custom-slick-next inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
                    aria-label="next slide">
                    <i class="ti ti-chevron-right"></i>
                </button>
            </div>
        @endif
    </div>

    <div id="slickCard-{{ $uniqueSliderId }}" class="slick-content slick-slider-align-start">
        @if (isset($datas) && count($datas) > 0)
            @foreach ($datas as $data)
                <div class="py-8 px-4">
                    <a href="/{{ $model }}/{{ $data->id }}-{{ $data->slug }}">
                        <div class="relative hover:scale-110 transition-transform duration-300">
                            @if ($data->image_path)
                                <x-image-skeleton src="{{ $data->image_path }}" alt="{{ $data->title }}"
                                    class="aspect-[300/500] w-full h-full object-cover rounded-xl" loading="lazy" />
                            @else
                                <x-image-skeleton src="https://placehold.co/2000x3000?text=No+Image+Available"
                                    alt="No Image Available" class="w-full h-full object-cover rounded-xl" />
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        @endif

        {{ $slot }}
    </div>

    @if ($useThumbDots && $dots)
        <div class="thumbnail-nav-{{ $uniqueSliderId }} mt-6">
            @if (isset($datas) && count($datas) > 0)
                @foreach ($datas as $data)
                    <div class="thumb-item-wrapper px-{{ $thumbnailSpacing / 2 }}">
                        <div class="thumb-item cursor-pointer rounded-lg overflow-hidden">
                            @if ($data->image_path)
                                <img src="{{ $data->image_path }}" alt="{{ $data->title }}"
                                    class="w-full h-full object-cover" loading="lazy" />
                            @else
                                <img src="https://placehold.co/2000x3000?text=No+Image+Available"
                                    alt="No Image Available" class="w-full h-full object-cover" />
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="thumbnail-nav-content-{{ $uniqueSliderId }}">
                    {{ $thumbnailSlot ?? '' }}
                </div>
            @endif
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (function(sliderId) {
            const slickElement = $('#slickCard-' + sliderId);
            const prevArrow = $('#prev-btn-' + sliderId);
            const nextArrow = $('#next-btn-' + sliderId);
            const useThumbDots = {{ $useThumbDots ? 'true' : 'false' }};

            if (slickElement.length) {
                const slickOptions = {
                    dots: {{ $dots ? 'true' : 'false' }},
                    arrows: {{ $arrows ? 'true' : 'false' }},
                    infinite: {{ $infinite ? 'true' : 'false' }},
                    speed: {{ $speed }},
                    slidesToShow: {{ $slidesToShow }},
                    slidesToScroll: {{ $slidesToScroll }},
                    autoplay: {{ $autoplay ? 'true' : 'false' }},
                    autoplaySpeed: {{ $autoplaySpeed }},
                    centerMode: {{ $centerMode ? 'true' : 'false' }},
                    centerPadding: '{{ $centerPadding }}',
                    adaptiveHeight: {{ $adaptiveHeight ? 'true' : 'false' }},
                    fade: {{ $fade ? 'true' : 'false' }},
                    lazyLoad: '{{ $lazyLoad }}',
                    prevArrow: prevArrow,
                    nextArrow: nextArrow,
                    @if ($responsive)
                        responsive: [{
                                breakpoint: {{ $desktopBreakpoint }},
                                settings: {
                                    slidesToShow: {{ $desktopSlidesToShow }},
                                    slidesToScroll: {{ $desktopSlidesToScroll }},
                                    infinite: {{ $infinite ? 'true' : 'false' }},
                                    dots: {{ $dots ? 'true' : 'false' }}
                                }
                            },
                            {
                                breakpoint: {{ $tabletBreakpoint }},
                                settings: {
                                    slidesToShow: {{ $tabletSlidesToShow }},
                                    slidesToScroll: {{ $tabletSlidesToScroll }}
                                }
                            },
                            {
                                breakpoint: {{ $mobileBreakpoint }},
                                settings: {
                                    slidesToShow: {{ $mobileSlidesToShow }},
                                    slidesToScroll: {{ $mobileSlidesToScroll }}
                                }
                            }
                        ]
                    @endif
                };

                if ({{ $customPaging ? 'true' : 'false' }} && useThumbDots) {
                    // Custom paging function for thumbnail dots
                    slickOptions.customPaging = function(slider, i) {
                        let thumbSrc;

                        // Check if it's a slide with custom image
                        const slideElement = $(slider.$slides[i]);
                        const img = slideElement.find('img').first();

                        if (img.length) {
                            thumbSrc = img.attr('src');
                        } else {
                            thumbSrc = "https://placehold.co/2000x3000?text=No+Image";
                        }

                        return '<button class="thumbnail-dot"><div class="thumb-preview"><img src="' +
                            thumbSrc + '" alt="thumbnail" /></div></button>';
                    };

                    // Set dotsClass to add custom class
                    slickOptions.dotsClass = 'slick-dots custom-thumbnail-dots';

                    // Initialize main slider
                    slickElement.slick(slickOptions);

                } else if (useThumbDots) {
                    // Initialize main slider
                    slickElement.slick(slickOptions);

                    // Initialize thumbnail navigation
                    $('.thumbnail-nav-' + sliderId).slick({
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        asNavFor: '#slickCard-' + sliderId,
                        dots: false,
                        arrows: false,
                        centerMode: false,
                        focusOnSelect: true,
                        infinite: {{ $infinite ? 'true' : 'false' }},
                        variableWidth: false,
                        // Add spacing between thumbnails
                        slideMargin: {{ $thumbnailSpacing }},
                        responsive: [{
                                breakpoint: {{ $desktopBreakpoint }},
                                settings: {
                                    slidesToShow: 4
                                }
                            },
                            {
                                breakpoint: {{ $tabletBreakpoint }},
                                settings: {
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: {{ $mobileBreakpoint }},
                                settings: {
                                    slidesToShow: 2
                                }
                            }
                        ]
                    });
                } else {
                    // Regular slider without custom dots
                    slickElement.slick(slickOptions);
                }

                // Sync with any existing nav slider
                if ($('.thumbnail-nav-' + sliderId).length && !useThumbDots) {
                    $('.thumbnail-nav-' + sliderId).on('click', '.slick-slide', function(e) {
                        e.preventDefault();
                        const index = $(this).data('slick-index');
                        slickElement.slick('slickGoTo', index);
                    });
                }
            }
        })('{{ $uniqueSliderId }}');
    });
</script>

<style>
    .custom-slick-prev.slick-disabled,
    .custom-slick-next.slick-disabled {
        opacity: 0.3;
        cursor: default;
    }

    .custom-slick-prev.slick-disabled:hover,
    .custom-slick-next.slick-disabled:hover {
        background: rgba(0, 0, 0, 0.3);
    }

    /* Dots styling */
    .slick-dots {
        bottom: -5rem;
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Standard dots spacing */
    .slick-dots li {
        margin: 0 {{ $thumbnailSpacing / 2 }}px;
    }

    .slick-dots li button:before {
        font-size: 12px;
    }

    /* Custom thumbnail dots spacing and styling */
    .custom-thumbnail-dots {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: {{ $thumbnailSpacing }}px;
        margin-top: 15px;
    }

    .custom-thumbnail-dots li {
        margin: {{ $thumbnailSpacing / 2 }}px;
        width: {{ $thumbnailSize }}px;
        height: {{ $thumbnailSize }}px;
    }

    /* Thumbnail dots */
    .slick-dots li .thumbnail-dot {
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        width: {{ $thumbnailSize }}px;
        height: {{ $thumbnailSize }}px;
        border-radius: 4px;
        overflow: hidden;
        transition: all 0.2s ease;
        opacity: 0.6;
        margin: 0;
    }

    .slick-dots li.slick-active .thumbnail-dot {
        opacity: 1;
        transform: scale(1.05);
        border: 2px solid #3498db;
    }

    .thumb-preview {
        width: 100%;
        height: 100%;
    }

    .thumb-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Thumbnail navigation */
    .thumbnail-nav-{{ $uniqueSliderId }} {
        margin: 0 -{{ $thumbnailSpacing / 2 }}px;
    }

    .thumbnail-nav-{{ $uniqueSliderId }} .slick-list {
        margin: 0 {{ $thumbnailSpacing }}px;
    }

    .thumbnail-nav-{{ $uniqueSliderId }} .thumb-item-wrapper {
        padding: 0 {{ $thumbnailSpacing / 2 }}px;
    }

    .thumbnail-nav-{{ $uniqueSliderId }} .thumb-item {
        border: 2px solid transparent;
        overflow: hidden;
        height: {{ $thumbnailSize }}px;
        transition: all 0.2s ease;
        opacity: 0.7;
    }

    .thumbnail-nav-{{ $uniqueSliderId }} .slick-current .thumb-item {
        opacity: 1;
        border-color: #3498db;
        transform: scale(1.05);
    }

    /* Animasi transisi pada slide */
    .slick-slide {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .slick-slider-align-start .slick-track {
        margin-left: 0 !important;
    }

    /* Active slide animation */
    .slick-current {
        z-index: 1;
    }

    .slick-current.slick-active {
        transform: scale(1.05);
        transition: transform 0.4s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .slick-dots li .thumbnail-dot {
            width: calc({{ $thumbnailSize }}px * 0.8);
            height: calc({{ $thumbnailSize }}px * 0.8);
        }

        .custom-thumbnail-dots {
            gap: {{ $thumbnailSpacing * 0.8 }}px;
        }

        .custom-thumbnail-dots li {
            margin: {{ $thumbnailSpacing * 0.4 }}px;
        }
    }

    @media (max-width: 480px) {
        .slick-dots li .thumbnail-dot {
            width: calc({{ $thumbnailSize }}px * 0.6);
            height: calc({{ $thumbnailSize }}px * 0.6);
        }

        .custom-thumbnail-dots {
            gap: {{ $thumbnailSpacing * 0.6 }}px;
        }
    }
</style>
