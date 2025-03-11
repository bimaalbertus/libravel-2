@if (auth()->check())
    <div x-data="{ navbarOpen: false }" class="relative z-[999]">
        <nav
            class="fixed w-full flex items-center justify-between h-14 p-4 md:py-8 lg:px-32 font-euclid-circular-b z-[100] bg-light-bg-primary dark:bg-dark-bg-primary">

            <x-nav-link />

            <div class="flex items-center gap-2 md:hidden">
                <livewire:live-search isIconOnly />
                <x-avatar-display type="circle" />
            </div>
            <div class="hidden md:flex items-center gap-4">
                <livewire:live-search />
                <div x-data="{ isOpen: false }" class="relative flex items-center" @mouseenter="isOpen = true"
                    @mouseleave="isOpen = false">
                    <a href="{{ route('profile.index', $user->username) }}"
                        class="inline-flex items-center hover:ring-2 ring-black dark:ring-white rounded-full"
                        bgColor="bg-none">
                        <x-avatar-display type="circle" />
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-12 right-0 w-64 rounded-lg bg-light-bg-secondary dark:bg-dark-bg-secondary border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5 z-50 text-sm font-figtree divide-y divide-neutral-600">
                        @if ($user)
                            <div
                                class="flex flex-col px-4 py-2 font-euclid-circular-b border-b border-black/10 dark:border-white/20">
                                <span
                                    class="font-semibold text-sm">{{ $user->username ? $user->username : $user->email }}</span>
                                <span
                                    class="font-md text-sm uppercase">{{ $user->status ? __('members/fields.fields.status.' . $user->status) : '' . ($user->major ? '/' . $user->major : '') }}
                                </span>
                            </div>
                        @endif
                        <div>
                            @if ($user->isAdmin())
                                <div class="py-2 px-2">
                                    <a href="{{ route('filament.admin.pages.dashboard') }}"
                                        class="inline-flex items-center justify-between w-full gap-2 py-1 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.dashboard') }}<i
                                            class="ti ti-brand-tabler mt-1 text-lg"></i></a>
                                </div>
                            @endif
                            <div class="py-2 px-2">
                                <a href="{{ route('profile.index', $user->username) }}"
                                    class="inline-flex items-center justify-between w-full gap-2 py-1 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.profile') }}<i
                                        class="ti ti-user-circle mt-1 text-lg"></i></a>
                            </div>
                            <div class="py-2 px-2">
                                <a href="{{ route('profile.read-later', $user->username) }}"
                                    class="inline-flex items-center justify-between w-full gap-2 py-1 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.read_later') }}<i
                                        class="ti ti-bookmark mt-1 text-lg"></i></a>
                            </div>
                            <div class="flex items-center justify-between py-4 px-4">
                                <span>{{ __('navigation/navigation.menus.theme') }}</span>
                                <x-theme-toggle type="small" />
                            </div>
                            <div class="flex items-center justify-between py-4 px-4">
                                <span>{{ __('navigation/navigation.menus.language') }}</span>
                                <x-language-switcher />
                            </div>
                        </div>
                        @if ($user)
                            <div class="py-2 px-2">
                                <livewire:logout />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="block lg:hidden">
            <x-modal open="navbarOpen" position="bottom" :closeIcon="false" blur="none" :zIndex="50">
                <div
                    class="flex flex-col justify-start pt-20 gap-4 w-screen overflow-hidden bg-light-bg-primary dark:bg-dark-bg-primary text-base text-black/50 dark:text-white/50 font-figtree h-screen p-4">
                    @if ($user)
                        <div class="flex items-center justify-between py-2 px-2 font-euclid-circular-b">
                            <div class="flex flex-col">
                                <span class="font-semibold text-sm">{{ $user->username }}</span>
                                <span
                                    class="font-md text-sm uppercase">{{ $user->status ? __('members/fields.fields.status.' . $user->status) : '' . ($user->major ? '/' . $user->major : '') }}
                                </span>
                            </div>
                            <x-avatar-display type="circle" :size="24" />
                        </div>
                        <ul class="y-2 text-gray-700 dark:text-gray-200">
                            @if ($user->isAdmin())
                                <li class="py-2">
                                    <a href="/admin"
                                        class="inline-flex items-center justify-between w-full gap-2 py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.dashboard') }}<i
                                            class="ti ti-brand-tabler mt-1 text-lg"></i></a>
                                </li>
                            @endif
                            <li class="py-2">
                                <a href="{{ route('profile.index', $user->username) }}"
                                    class="inline-flex items-center justify-between w-full gap-2 py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.profile') }}<i
                                        class="ti ti-user-circle mt-1 text-lg"></i></a>
                            </li>
                            <li class="py-2">
                                <div class="flex items-center justify-between py-1 px-2">
                                    <span>{{ __('navigation/navigation.menus.theme') }}</span>
                                    <x-theme-toggle type="large" />
                                </div>
                            </li>
                            <li class="pb-2">
                                <div class="flex items-center justify-between py-4 px-2">
                                    <span>{{ __('navigation/navigation.menus.language') }}</span>
                                    <x-language-switcher />
                                </div>
                            </li>
                            @if ($user)
                                <li class=" pt-2">
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-between w-full gap-2 cursor-pointer py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">
                                            <span>{{ __('navigation/navigation.menus.signout') }}</span>
                                            <i class="ti ti-logout mt-1 text-lg"></i>
                                        </button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    @endif
                    @if (!$user)
                        <div class="flex flex-col gap-4">
                            <a href="/auth/login"><button type="button"
                                    class="cursor-pointer whitespace-nowrap rounded-md bg-transparent px-4 py-2 font-figtree text-sm font-semibold tracking-wide w-full text-light-on-bg dark:text-dark-on-bg border border-gray-300 dark:border-gray-800 transition-all duration-300 hover:bg-dark-bg/5 dark:hover:bg-light-bg/5 text-center">Login</button></a>
                            <a href="/auth/register"><button type="button"
                                    class="cursor-pointer whitespace-nowrap rounded-md bg-dark-bg dark:bg-light-bg px-4 py-2 font-figtree text-sm font-semibold tracking-wide w-full text-dark-on-bg dark:text-light-on-bg border border-gray-300 dark:border-gray-800 transition-all duration-300 hover:bg-opacity-85 dark:hover:bg-opacity-85 text-center">Register</button></a>
                        </div>
                    @endif
                    <div class="flex flex-col pt-8 gap-4 border-t border-black/10 dark:border-white/20">
                        <a href="/"
                            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('/') }}' }"
                            class="inline-flex items-center p-2 hover:bg-black/10 dark:hover:bg-white/10 rounded-md hover:text-black dark:hover:text-white transition duration-100">{{ __('navigation/navigation.home') }}</a>
                        <a href="/discover"
                            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('discover') }}' }"
                            class="inline-flex items-center p-2 hover:bg-black/10 dark:hover:bg-white/10 rounded-md hover:text-black dark:hover:text-white transition duration-100">{{ __('navigation/navigation.links.discover') }}</a>
                        <a href="/favorites"
                            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('favorites') }}' }"
                            class="inline-flex items-center p-2 hover:bg-black/10 dark:hover:bg-white/10 rounded-md hover:text-black dark:hover:text-white transition duration-100">{{ __('navigation/navigation.links.favorite') }}</a>
                    </div>
                </div>
            </x-modal>
        </div>
    </div>
@else
    <div x-data="{
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
    }" class="relative z-[999]">
        <nav x-show="showNavbar" x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-64 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in-out duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-64 scale-95"
            class="fixed mx-auto top-5 md:top-10 left-0 right-0 w-full max-w-md md:max-w-7xl flex items-center justify-between p-3 md:p-1 font-euclid-circular-b rounded-2xl bg-light-bg-secondary dark:bg-dark-bg-secondary hover:shadow-xl transition-all duration-300 ease-initial">

            <div class="flex lg:flex-row md:pl-6 items-center gap-6 justify-between">
                <a href="/" class="hover:scale-105 transition ease-in-out">
                    <x-logo />
                </a>

                <ul x-data="{ open: false }" class="hidden md:flex gap-4 text-[13px] font-manrope font-semibold">
                    <li
                        class="relative h-full grid text-dark-bg dark:text-light-bg hover:bg-[#554D34]/10 dark:hover:bg-dark-btn-primary/10 px-4 py-2 rounded-lg transition duration-200 ease-in-out cursor-pointer">
                        <a href="/">{{ __('navigation/navigation.home') }}</a>
                    </li>

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
                </ul>
            </div>

            <div class="flex items-center gap-2">
                <livewire:live-search isIconOnly />
                <x-language-switcher type="icon" />
                <x-theme-toggle type="icon" />

                <x-animated-button href="/auth/login" name="{{ __('pages/login.title') }}" icon="ti-login-2" />
            </div>
        </nav>
    </div>
@endif
