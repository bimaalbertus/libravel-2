<div class="flex items-center lg:gap-8">
    <button class="block lg:hidden w-10 h-10 relative focus:outline-none mr-4" @click="navbarOpen = !navbarOpen">
        <div class="block w-5 absolute left-1/2 top-1/2  transform  -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true"
                class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                :class="{ 'rotate-45': navbarOpen, ' -translate-y-1.5': !navbarOpen }"></span>
            <span aria-hidden="true"
                class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out"
                :class="{ 'opacity-0': navbarOpen }"></span>
            <span aria-hidden="true"
                class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out"
                :class="{ '-rotate-45': navbarOpen, ' translate-y-1.5': !navbarOpen }"></span>
        </div>
    </button>
    <a href="/">
        <x-logo type="name" />
    </a>
    <div class="hidden lg:flex gap-4 mr-10 text-black/50 dark:text-white/50 font-figtree text-sm">
        <a href="/"
            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('/') }}' }"
            class="inline-flex items-center py-1 px-2 rounded-md hover:text-black dark:hover:text-white transition duration-300">{{ __('navigation/navigation.home') }}</a>
        <a href="/discover"
            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('discover') }}' }"
            class="inline-flex items-center py-1 px-2 rounded-md hover:text-black dark:hover:text-white transition duration-300">{{ __('navigation/navigation.links.discover') }}</a>
        <a href="/favorites"
            :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('favorites') }}' }"
            class="inline-flex items-center py-1 px-2 rounded-md hover:text-black dark:hover:text-white transition duration-300">{{ __('navigation/navigation.links.favorite') }}</a>
    </div>
</div>
