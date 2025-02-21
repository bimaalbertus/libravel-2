<div x-data="{ navbarOpen: false }" class="z-[100]">
    <nav
        class="fixed w-full flex items-center justify-between h-14 p-4 md:py-8 lg:px-32 font-euclid-circular-b z-[100] bg-light-bg-primary dark:bg-dark-bg-primary">

        <x-nav-link />

        <span class="block md:hidden">
            {!! $user->getAvatar(40, 'circle') !!}
        </span>
        <div class="hidden md:flex items-center gap-4">
            <div x-data="{ isOpen: false }" class="relative flex items-center">
                <button @click="isOpen = !isOpen" class="inline-flex items-center">
                    @if (!$user)
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="size-6">
                            <path
                                d="M1.5 3C1.22386 3 1 3.22386 1 3.5C1 3.77614 1.22386 4 1.5 4H13.5C13.7761 4 14 3.77614 14 3.5C14 3.22386 13.7761 3 13.5 3H1.5ZM1 7.5C1 7.22386 1.22386 7 1.5 7H13.5C13.7761 7 14 7.22386 14 7.5C14 7.77614 13.7761 8 13.5 8H1.5C1.22386 8 1 7.77614 1 7.5ZM1 11.5C1 11.2239 1.22386 11 1.5 11H13.5C13.7761 11 14 11.2239 14 11.5C14 11.7761 13.7761 12 13.5 12H1.5C1.22386 12 1 11.7761 1 11.5Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    @else
                        {!! $user->getAvatar(40, 'circle') !!}
                    @endif
                </button>
                <div x-show="isOpen" @click.away="isOpen = false" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute top-14 right-0 w-64 rounded-lg bg-light-bg-secondary dark:bg-dark-bg-secondary border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5 z-50 text-sm font-figtree divide-y divide-neutral-600">
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
                        @if ($user)
                            @if ($user->status === 'admin')
                                <div class="py-2 px-2">
                                    <a href="{{ route('filament.admin.pages.dashboard') }}"
                                        class="inline-flex items-center justify-between w-full gap-2 py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.dashboard') }}<i
                                            class="ti ti-brand-tabler mt-1 text-lg"></i></a>
                                </div>
                            @endif
                            <div class="py-2 px-2">
                                <a href="/settings/account"
                                    class="inline-flex items-center justify-between w-full gap-2 py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.profile') }}<i
                                        class="ti ti-user-circle mt-1 text-lg"></i></a>
                            </div>
                        @endif
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
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center justify-between w-full gap-2 cursor-pointer py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">
                                    <span>{{ __('navigation/navigation.menus.signout') }}</span>
                                    <i class="ti ti-logout mt-1 text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="block lg:hidden">
        <x-modal open="navbarOpen" position="bottom" :closeIcon="false" blur="none" :zIndex="50">
            <div
                class="flex flex-col justify-start pt-20 gap-4 w-screen overflow-hidden bg-light-bg dark:bg-dark-bg text-base text-black/50 dark:text-white/50 font-figtree h-screen p-4">
                @if ($user)
                    <div class="flex items-center justify-between py-2 px-2 font-euclid-circular-b">
                        <div class="flex flex-col">
                            <span
                                class="font-semibold text-sm">{{ $user->username ? $user->username : $user->email }}</span>
                            <span
                                class="font-md text-sm uppercase">{{ $user->status ? __('members/fields.fields.status.' . $user->status) : '' . ($user->major ? '/' . $user->major : '') }}
                            </span>
                        </div>
                        {!! $user->getAvatar(24, 'circle') !!}
                    </div>
                    <ul class="y-2 text-gray-700 dark:text-gray-200">
                        @if ($user->status === 'admin')
                            <li class="py-2">
                                <a href="/admin"
                                    class="inline-flex items-center justify-between w-full gap-2 py-2 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">{{ __('navigation/navigation.menus.dashboard') }}<i
                                        class="ti ti-brand-tabler mt-1 text-lg"></i></a>
                            </li>
                        @endif
                        <li class="py-2">
                            <a href="/settings/account"
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
