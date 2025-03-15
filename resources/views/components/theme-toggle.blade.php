@props([
    'type' => 'large',
    'iconColor' => 'text-black dark:text-white',
])

<div x-data="themeSwitch()" x-init="$watch('theme', value => setTheme(value));
setTheme(theme)" @click.away="open = false" class="relative">
    @switch($type)
        @case('small')
            <button class="flex items-center gap-0.5 bg-transparent border border-black/20 dark:border-white/20 rounded-full">
                <!-- Tombol Sistem -->
                <span @click.prevent="setTheme('system')"
                    :class="{
                        'bg-black text-white dark:bg-white dark:text-black scale-110': theme === 'system',
                        'text-black/50 dark:text-white/50': theme !== 'system'
                    }"
                    class="p-1 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-[15px]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path stroke-width="2"
                            d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                        <path stroke-width="2" d="M12 5v16" />
                        <path stroke-width="2" d="M7 7h1" />
                        <path stroke-width="2" d="M7 11h1" />
                        <path stroke-width="2" d="M16 7h1" />
                        <path stroke-width="2" d="M16 11h1" />
                        <path stroke-width="2" d="M16 15h1" />
                    </svg>
                </span>

                <!-- Tombol Terang -->
                <span @click.prevent="setTheme('light')"
                    :class="{
                        'bg-black text-white dark:bg-white dark:text-black scale-110': theme === 'light',
                        'text-black/50 dark:text-white/50': theme !== 'light'
                    }"
                    class="p-1 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-[15px]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>

                <!-- Tombol Gelap -->
                <span @click.prevent="setTheme('dark')"
                    :class="{
                        'bg-black text-white dark:bg-white dark:text-black scale-110': theme === 'dark',
                        'text-black/50 dark:text-white/50': theme !== 'dark'
                    }"
                    class="p-1 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-[15px]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </span>
            </button>
        @break

        @case('icon')
            <div x-data="{ iconOpen: false }">
                <span @click="iconOpen= !iconOpen"
                    class="inline-flex items-center justify-center p-2 bg-black dark:bg-white rounded-xl {{ $iconColor }} bg-opacity-0 hover:bg-opacity-10 dark:bg-opacity-0 dark:hover:bg-opacity-10 transition ease-linear cursor-pointer">
                    <svg x-show="theme === 'system'" x-cloak xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path stroke-width="2"
                            d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                        <path stroke-width="2" d="M12 5v16" />
                        <path stroke-width="2" d="M7 7h1" />
                        <path stroke-width="2" d="M7 11h1" />
                        <path stroke-width="2" d="M16 7h1" />
                        <path stroke-width="2" d="M16 11h1" />
                        <path stroke-width="2" d="M16 15h1" />
                    </svg>
                    <svg x-show="theme ==='light'" x-cloak xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="theme === 'dark'" x-cloak xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </span>

                <div x-show="iconOpen" x-cloak x-on:click.away="iconOpen = false"
                    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8"
                    class="absolute -left-20">
                    <div
                        class="flex flex-col justify-center w-32 bg-light-bg-secondary dark:bg-dark-bg-secondary mt-5 p-1 rounded-lg font-geist-sans font-medium">
                        <span @click.prevent="setTheme('light')" x-on:click="iconOpen = false"
                            class="inline-flex items-center gap-2 p-1.5 rounded-md cursor-pointer hover:text-neutral-200 hover:bg-light-primary dark:hover:bg-dark-primary">
                            <p>Light</p>
                        </span>
                        <span @click.prevent="setTheme('dark')" x-on:click="iconOpen = false"
                            class="inline-flex items-center gap-2 p-1.5 rounded-md cursor-pointer hover:text-neutral-200 hover:bg-light-primary dark:hover:bg-dark-primary">
                            <p>Dark</p>
                        </span>
                        <span @click.prevent="setTheme('system')" x-on:click="iconOpen = false"
                            class="inline-flex items-center gap-2 p-1.5 rounded-md cursor-pointer hover:text-neutral-200 hover:bg-light-primary dark:hover:bg-dark-primary">
                            <p>System</p>
                        </span>
                    </div>
                </div>
            </div>
        @break

        @default
            <button class="flex items-center gap-1 bg-transparent border border-black/20 dark:border-white/20 rounded-full">
                <span @click.prevent="setTheme('system')"
                    :class="{ 'bg-black text-white dark:bg-white dark:text-black scale-125': theme === 'system' }"
                    class="p-1.5 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-vocabulary size-[1.15rem]">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                        <path d="M12 5v16" />
                        <path d="M7 7h1" />
                        <path d="M7 11h1" />
                        <path d="M16 7h1" />
                        <path d="M16 11h1" />
                        <path d="M16 15h1" />
                    </svg>
                </span>
                <span @click.prevent="setTheme('light')"
                    :class="{ 'bg-black text-white dark:bg-white dark:text-black scale-125': theme === 'light' }"
                    class="p-1.5 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-[1.15rem]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
                <span @click.prevent="setTheme('dark')"
                    :class="{ 'bg-black text-white dark:bg-white dark:text-black scale-125': theme === 'dark' }"
                    class="p-1.5 rounded-full transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-[1.15rem]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </span>
            </button>
    @endswitch
</div>

<script>
    function themeSwitch() {
        return {
            theme: localStorage.getItem('theme') || 'system',
            setTheme(newTheme) {
                this.theme = newTheme;
                localStorage.setItem('theme', newTheme);
                if (newTheme === 'dark' || (newTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                this.open = false;
            }
        }
    }
</script>
