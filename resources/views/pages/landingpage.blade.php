<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F1F5F9] dark:bg-[#030806] text-[#222222] dark:text-[#fff] scroll-smooth">
    <div x-data>
        <img src="/gradients/docs-left.png"
            class="block fixed -left-32 w-[65rem] opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none rounded-large -z-10"
            alt="docs left background" data-loaded="true" x-on:contextmenu.prevent />
        <img src="/gradients/docs-right.png"
            class="block fixed -right-96 -top-72 w-[75rem] rotate-180 opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none rounded-large -z-10"
            alt="docs right background" data-loaded="true" x-on:contextmenu.prevent />
    </div>

    <nav
        class="fixed top-0 w-full flex items-center justify-between p-4 md:py-8 lg:px-32 font-euclid-circular-b z-[999]">
        <a href="/">
            <x-logo type="name" />
        </a>

        <div
            class="hidden md:flex absolute top-7 left-1/2 transform -translate-x-1/2 lg:flex lg:flex-row items-center h-10 px-3 py-2 rounded-xl bg-[#0035184d] border border-[#FFFFFF33] gap-14 justify-between">
            <ul class="flex gap-10 text-[13px] font-albert-sans">

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center text-white hover:text-black dark:hover:text-[#02F67C] transition duration-300 ease-in-out">
                        <span>{{ __('navigation/navigation.browse.title') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 mt-5 w-48 rounded-xl bg-[#0035189c] border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5"
                        style="display: none;">
                        <div class="p-4 space-y-3">
                            <a href="#"
                                class="font-sans not-italic font-normal text-[13px] text-[#FFFFFF] hover:scale-[97%] hover:text-black dark:hover:text-[#02F67C] flex-grow flex gap-[8px] items-center whitespace-nowrap transition duration-300 ease-in-out">{{ __('navigation/navigation.browse.subject') }}</a>
                            <a href="#"
                                class="font-sans not-italic font-normal text-[13px] text-[#FFFFFF] hover:scale-[97%] hover:text-black dark:hover:text-[#02F67C] flex-grow flex gap-[8px] items-center whitespace-nowrap transition duration-300 ease-in-out">{{ __('navigation/navigation.browse.trending') }}</a>
                            <a href="#"
                                class="font-sans not-italic font-normal text-[13px] text-[#FFFFFF] hover:scale-[97%] hover:text-black dark:hover:text-[#02F67C] flex-grow flex gap-[8px] items-center whitespace-nowrap transition duration-300 ease-in-out">
                                {{ __('navigation/navigation.browse.random_books') }}</a>
                            <a href="#"
                                class="font-sans not-italic font-normal text-[13px] text-[#FFFFFF] hover:scale-[97%] hover:text-black dark:hover:text-[#02F67C] flex-grow flex gap-[8px] items-center whitespace-nowrap transition duration-300 ease-in-out">{{ __('navigation/navigation.browse.genre') }}</a>
                        </div>
                    </div>
                </div>

                <li
                    class="relative h-full grid text-white text-[13px] hover:text-black dark:hover:text-[#02F67C] transition duration-200 ease-in-out cursor-pointer">
                    {{ __('navigation/navigation.home') }}</li>

                <li
                    class="relative h-full grid text-white text-[13px] hover:text-black dark:hover:text-[#02F67C] transition duration-200 ease-in-out cursor-pointer">
                    {{ __('navigation/navigation.about') }}</li>
            </ul>

            <ul>
                <li>
                    <a href="https://github.com/libravel" target="_blank">
                        <div class="flex items-center gap-1 rounded-md bg-[#23413B97] px-3 py-[3px] h-full">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5">
                                <path
                                    d="M6 0.25C2.685 0.25 0 2.89 0 6.146C0 8.7515 1.719 10.961 4.1025 11.74C4.4025 11.7955 4.5125 11.613 4.5125 11.4565C4.5125 11.3165 4.5075 10.9455 4.505 10.454C2.836 10.8095 2.484 9.663 2.484 9.663C2.211 8.9825 1.8165 8.8005 1.8165 8.8005C1.273 8.435 1.8585 8.4425 1.8585 8.4425C2.461 8.4835 2.7775 9.05 2.7775 9.05C3.3125 9.9515 4.182 9.691 4.525 9.5405C4.579 9.159 4.7335 8.8995 4.905 8.752C3.5725 8.6045 2.172 8.0975 2.172 5.8385C2.172 5.195 2.4045 4.669 2.7895 4.2565C2.722 4.1075 2.5195 3.508 2.842 2.696C2.842 2.696 3.3445 2.538 4.492 3.3005C4.972 3.1695 5.482 3.1045 5.992 3.1015C6.502 3.1045 7.012 3.1695 7.492 3.3005C8.632 2.538 9.1345 2.696 9.1345 2.696C9.457 3.508 9.2545 4.1075 9.1945 4.2565C9.577 4.669 9.8095 5.195 9.8095 5.8385C9.8095 8.1035 8.407 8.602 7.072 8.747C7.282 8.924 7.477 9.2855 7.477 9.838C7.477 10.627 7.4695 11.261 7.4695 11.4525C7.4695 11.607 7.5745 11.7915 7.882 11.7325C10.2825 10.9585 12 8.7475 12 6.146C12 2.89 9.3135 0.25 6 0.25Z"
                                    fill="currentColor"></path>
                            </svg>
                            <span class="text-xs">Our Github</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex items-center gap-4">
            <a href="/auth/login">
                <span
                    class="uppercase text-xs text-neutral-400 p-2 hover:bg-black/10 hover:dark:bg-white/10 rounded-md transition duration-200 ease-in-out">{{ __('pages/login.title') }}</span>
            </a>

            <div x-data="{ isOpen: false }" class="relative flex items-center">
                <button @click="isOpen = !isOpen" class="inline-flex items-center">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="size-6">
                        <path
                            d="M1.5 3C1.22386 3 1 3.22386 1 3.5C1 3.77614 1.22386 4 1.5 4H13.5C13.7761 4 14 3.77614 14 3.5C14 3.22386 13.7761 3 13.5 3H1.5ZM1 7.5C1 7.22386 1.22386 7 1.5 7H13.5C13.7761 7 14 7.22386 14 7.5C14 7.77614 13.7761 8 13.5 8H1.5C1.22386 8 1 7.77614 1 7.5ZM1 11.5C1 11.2239 1.22386 11 1.5 11H13.5C13.7761 11 14 11.2239 14 11.5C14 11.7761 13.7761 12 13.5 12H1.5C1.22386 12 1 11.7761 1 11.5Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="isOpen" @click.away="isOpen = false" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute top-14 right-0 w-64 rounded-lg bg-white dark:bg-[#1e1e1e] border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5 z-50 text-sm font-figtree divide-y divide-neutral-600">
                    <div>
                        <div class="flex items-center justify-between py-4 px-4">
                            <span>{{ __('navigation/navigation.menus.theme') }}</span>
                            <x-theme-toggle type="small" />
                        </div>
                        <div class="flex items-center justify-between py-4 px-4">
                            <span>{{ __('navigation/navigation.menus.language') }}</span>
                            <x-language-switcher />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8 md:py-14 font-euclid-circular-b">
        <div class="h-screen">
            <div class="flex px-4 md:px-8 py-32">
                <section class="flex flex-col items-center justify-center mx-auto">
                    <div class="flex flex-col items-center space-y-0 text-center">
                        <h1
                            class="text-[6rem] font-medium text-[#02F67C] font-jersey-15 leading-[38px] md:leading-[100%] lg:leading-[80px]">
                            How Modern School</h1>
                        <h1 class="text-[4rem] font-medium leading-[38px] md:leading-[100%] lg:leading-[80px]">Organize
                            their
                            Library</h1>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>

</html>
