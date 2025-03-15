@extends('layouts.app', ['nav' => false])
@section('title', 'Server Error - ')

@push('styles')
    <style>
        section {
            font-family: Consolas, monaco, monospace;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.2rem;
            text-align: center;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: black;
            padding: 20px 0;
            border-top: 1px dashed rgba(255, 255, 255, 0.2);
            margin-top: 20px;
        }
    </style>
@endpush

@section('content')
    <section>
        <div id="particles-js"></div>

        <div class="relative z-10 text-center text-white/50">
            <x-text-reveal text="500" textClass="text-4xl font-bold" :initialDelay="0.1" />
            <x-text-reveal text="{{ __('navigation/navigation.errors.500.heading') }}." textClass="mt-4 text-base md:text-lg"
                :delayBetweenChars="0.02" :initialDelay="0.3" />
            <x-text-reveal text="{{ __('navigation/navigation.errors.500.content') }}." textClass="text-base md:text-lg"
                :initialDelay="1.5" />
        </div>


        <footer>
            <p>© {{ env('SHORT_NAME', 'libravel_') }} 2024-2025.</p>
        </footer>

    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 200,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 1,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0,
                        "sync": false
                    }
                },
                "size": {
                    "value": 1.5,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 4,
                        "size_min": 0.3,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": false,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 600
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": false,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 250,
                        "size": 0,
                        "duration": 2,
                        "opacity": 0,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 400,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": false
        });
        var count_particles, stats, update;
        stats = new Stats;
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
        count_particles = document.querySelector('.js-count-particles');
        update = function() {
            stats.begin();
            stats.end();
            if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
                count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
            }
            requestAnimationFrame(update);
        };
        requestAnimationFrame(update);;
    </script>
@endpush
