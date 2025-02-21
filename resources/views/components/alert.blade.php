@props([
    'position' => 'top-right',
    'duration' => 5000,
    'maxToasts' => 5,
    'animation' => true,
    'pauseOnHover' => true,
    'showProgress' => true,
])

@php
    $colors = [
        'success' =>
            'bg-light-bg-secondary dark:bg-dark-bg-secondary border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300',
        'error' =>
            'bg-light-bg-secondary dark:bg-dark-bg-secondary border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300',
        'warning' =>
            'bg-light-bg-secondary dark:bg-dark-bg-secondary border border-yellow-200 dark:border-yellow-800 text-yellow-700 dark:text-yellow-300',
        'info' =>
            'bg-light-bg-secondary dark:bg-dark-bg-secondary border border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-300',
        'neutral' =>
            'bg-light-bg-secondary dark:bg-dark-bg-secondary border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300',
    ];

    $icons = [
        'success' =>
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
        'error' =>
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
        'warning' =>
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
        'info' =>
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'neutral' =>
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    ];

    $positionClasses = [
        'top-right' => 'top-24 right-10',
        'top-left' => 'top-24 left-10',
        'top-center' => 'top-24 left-1/2 transform -translate-x-1/2',
        'bottom-right' => 'bottom-20 right-10',
        'bottom-left' => 'bottom-20 left-10',
        'bottom-center' => 'bottom-20 left-1/2 transform -translate-x-1/2',
    ];

    $sessionMessages = [
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info'),
        'neutral' => session('neutral'),
    ];
@endphp

@if (collect($sessionMessages)->filter()->isNotEmpty())
    <div x-data="toastStore()" x-init="initializeToasts()" @mouseenter="if ({{ $pauseOnHover }}) { pauseAll() }"
        @mouseleave="if ({{ $pauseOnHover }}) { resumeAll() }">
        <div
            class="fixed z-50 w-full max-w-sm sm:max-w-sm md:max-w-md {{ $positionClasses[$position] }} font-euclid-circular-b">
            <template x-for="toast in toasts" :key="toast.id">
                <div :id="toast.id" class="absolute w-full transform duration-300 ease-out select-none"
                    :class="{ 'cursor-grab': toast.isDragging }" @mousedown="startDragging(toast)"
                    @mousemove="handleDragging(toast, $event)" @mouseup="stopDragging(toast)"
                    @mouseleave="stopDragging(toast)">
                    <div class="flex items-center p-4 rounded-lg shadow-lg gap-4"
                        :class="toast.type ? colors[toast.type] : '{{ $colors['info'] }}'">

                        <div class="flex-shrink-0" x-html="toast.type ? icons[toast.type] : '{{ $icons['info'] }}'">
                        </div>

                        <div class="flex-grow">
                            <div x-text="toast.message" class="text-sm"></div>
                        </div>

                        <button @click="burnToast(toast.id)"
                            class="flex-shrink-0 ml-auto pl-3 hover:opacity-80 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
        function toastStore() {
            return {
                toasts: [],
                colors: @json($colors),
                icons: @json($icons),
                position: '{{ $position }}',
                paddingBetween: 10,
                maxToasts: {{ $maxToasts }},
                draggingToast: null,
                startX: 0,
                startY: 0,

                initializeToasts() {
                    const sessionMessages = @json($sessionMessages);
                    Object.entries(sessionMessages).forEach(([type, message]) => {
                        if (message) {
                            this.addToast(message, type);
                        }
                    });
                },

                addToast(message, type = 'info', duration = {{ $duration }}) {
                    const toast = {
                        id: 'toast-' + Math.random().toString(16).slice(2),
                        message,
                        type,
                        progress: 100,
                        startTime: Date.now(),
                        duration,
                        remainingTime: duration,
                        isPaused: false,
                        isDragging: false,
                        translateX: 0
                    };

                    if (this.toasts.length >= this.maxToasts) {
                        this.burnToast(this.toasts[this.toasts.length - 1].id);
                    }

                    this.toasts.unshift(toast);
                    this.stackToasts();
                    this.startProgress(toast);
                },

                startProgress(toast) {
                    if (!{{ $animation }}) return;

                    const interval = 10;
                    const tick = () => {
                        if (toast.isPaused) return;

                        const elapsed = Date.now() - toast.startTime;
                        toast.progress = Math.max(0, ((toast.duration - elapsed) / toast.duration) * 100);

                        if (toast.progress > 0) {
                            requestAnimationFrame(tick);
                        } else {
                            this.burnToast(toast.id);
                        }
                    };

                    requestAnimationFrame(tick);
                },

                pauseAll() {
                    this.toasts.forEach(toast => {
                        toast.isPaused = true;
                        toast.remainingTime = (toast.progress / 100) * toast.duration;
                    });
                },

                resumeAll() {
                    this.toasts.forEach(toast => {
                        toast.isPaused = false;
                        toast.startTime = Date.now() - (toast.duration - toast.remainingTime);
                        this.startProgress(toast);
                    });
                },

                startDragging(toast) {
                    toast.isDragging = true;
                    this.draggingToast = toast;
                    this.startX = event.clientX;
                },

                handleDragging(toast, event) {
                    if (!toast.isDragging) return;

                    const deltaX = event.clientX - this.startX;
                    toast.translateX = deltaX;

                    const element = document.getElementById(toast.id);
                    if (element) {
                        element.style.transform = `translateX(${deltaX}px)`;
                        element.style.opacity = Math.max(0, 1 - Math.abs(deltaX) / 200);
                    }

                    if (Math.abs(deltaX) > 200) {
                        this.burnToast(toast.id);
                    }
                },

                stopDragging(toast) {
                    if (!toast.isDragging) return;

                    toast.isDragging = false;
                    this.draggingToast = null;

                    const element = document.getElementById(toast.id);
                    if (element) {
                        if (Math.abs(toast.translateX) < 200) {
                            element.style.transform = 'translateX(0)';
                            element.style.opacity = 1;
                        }
                    }

                    toast.translateX = 0;
                },

                burnToast(id) {
                    const toast = document.getElementById(id);
                    if (!toast) return;

                    toast.classList.add('opacity-0');
                    if (this.position.includes('right')) {
                        toast.style.transform = 'translateX(100%)';
                    } else if (this.position.includes('left')) {
                        toast.style.transform = 'translateX(-100%)';
                    } else {
                        toast.style.transform = 'translateY(-100%)';
                    }

                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                        this.stackToasts();
                    }, 300);
                },

                stackToasts() {
                    if (this.toasts.length === 0) return;

                    this.toasts.forEach((toast, index) => {
                        const element = document.getElementById(toast.id);
                        if (!element || toast.isDragging) return;

                        element.style.zIndex = 100 - index;
                        const offset = index * (element.offsetHeight + this.paddingBetween);

                        if (this.position.includes('bottom')) {
                            element.style.bottom = offset + 'px';
                        } else {
                            element.style.top = offset + 'px';
                        }
                    });
                }
            }
        }
    </script>
@endif
