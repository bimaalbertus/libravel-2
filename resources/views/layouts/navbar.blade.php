<nav class="fixed w-full flex justify-between p-4 md:py-8 lg:px-32 font-euclid-circular-b z-[999]">
    <a href="/">
        <h1 class="text-2xl font-semibold font-afacad-flux">{{ env('SHORT_NAME') }}</h1>
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
                    class="absolute left-0 mt-5 w-48 rounded-xl bg-[#0035184d] border border-[#FFFFFF33] ring-1 ring-black ring-opacity-5"
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

    <div class="flex items-center">
        <x-theme-toggle type="small" />
        <x-language-switcher />
    </div>
</nav>
