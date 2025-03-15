<div class="hidden lg:flex gap-4 mr-10 text-black/50 dark:text-white/50 font-figtree text-sm">
    <a href="/" :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('/') }}' }"
        class="inline-flex items-center py-1 px-2 rounded-md hover:text-black dark:hover:text-white transition duration-300">{{ __('navigation/navigation.home') }}</a>
    <a href="/readl-later"
        :class="{ 'bg-black/10 dark:bg-white/10 text-black dark:text-white': '{{ Request::is('readl-later') }}' }"
        class="inline-flex items-center py-1 px-2 rounded-md hover:text-black dark:hover:text-white transition duration-300">{{ __('navigation/navigation.menus.read_later') }}</a>
</div>
