<div
    class="hidden md:block z-50 fixed inset-y-4 top-14 left-0 w-64 rounded-xl bg-light-bg dark:bg-dark-bg shadow-lg p-6 overflow-y-auto">
    <div class="py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/"
                    class="flex items-center gap-3 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-light-bg/20 group">
                    <x-radix name="home" :size="28" />
                    <span>{{ __('navigation/navigation.home') }}</span>
                </a>
            </li>

            <li x-data="{ open: false }" class="w-full">
                <button type="button" @click="open = !open"
                    class="flex items-center gap-3 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-light-bg/20 group w-full"
                    aria-expanded="true" aria-controls="users-accordion-collapse-1">
                    <x-radix name="globe" :size="28" />
                    {{ __('navigation/navigation.browse.title') }}

                    <x-radix name="chevron-down" :size="16"
                        class="text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" />
                </button>

                <div x-show="open"
                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                    role="region" aria-labelledby="users-accordion">
                    <ul class="hs-accordion-group pt-1 ps-7 space-y-1">
                        <li>
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hs-accordion-active:text-white dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                aria-expanded="true" aria-controls="users-accordion-sub-1-collapse-1">
                                Sub Menu 1

                                <svg class="hs-accordion-active:block ms-auto hidden size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="users-accordion-sub-1-collapse-1"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                <ul class="pt-1 ps-2 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                            href="#">
                                            Link 1
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                            href="#">
                                            Link 2
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                            href="#">
                                            Link 3
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
    </div>
</div>
