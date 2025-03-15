<div x-data="{ downloadOpen: @entangle('downloadOpen') }">
    @if ($book->getFirstMedia('book.documents'))
        <x-button x-on:click="downloadOpen = !downloadOpen" width="w-10" height="h-10"
            class="inline-flex items-center gap-2 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                <path d="M7 11l5 5l5 -5" />
                <path d="M12 4l0 12" />
            </svg>
        </x-button>

        @if ($user)
            <x-modal open="downloadOpen" :closeIcon="false">
                <div
                    class="flex flex-col mx-auto p-4 bg-light-bg-secondary dark:bg-dark-bg-secondary rounded-xl w-full max-w-96">
                    <button x-on:click="downloadOpen = false" aria-label="close modal" class="ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="flex flex-col items-center gap-4 mx-auto w-full">
                        <span
                            class="inline-flex items-center justify-center rounded-full size-12 bg-light-accent-primary dark:bg-dark-accent-secondary">
                            <i class="ti ti-download text-4xl dark:text-white"></i>
                        </span>
                        <h1 class="text-2xl font-semibold text-black dark:text-white">
                            {{ __('download.title') }}?</h1>
                        @if ($size)
                            <span class="text-neutral-500 -mt-4">{{ __('download.size') . ': ' . $size }}</span>
                        @endif
                        <div class="flex items-center gap-4 w-full">
                            <x-button x-on:click="downloadOpen = false" bg-color="bg-transparent" width="w-full"
                                class="border-2 border-neutral-600 text-black dark:text-white hover:opacity-60">{{ __('profile.cancel') }}</x-button>
                            <x-button wire:click="downloadDocument" :loading="true"
                                bg-color="bg-light-accent-primary dark:bg-dark-accent-secondary" width="w-full"
                                class="text-black dark:text-white hover:opacity-60">{{ __('download.yes_download') }}</x-button>
                        </div>
                    </div>
                </div>
            </x-modal>
        @else
            <x-modal open="downloadOpen">
                <div
                    class="flex flex-col mx-auto p-4 bg-light-bg-secondary dark:bg-dark-bg-secondary rounded-xl w-full max-w-xl">
                    <button x-on:click="downloadOpen = false" aria-label="close modal" class="ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="flex flex-col items-center gap-4 mx-auto w-full">
                        <div class="flex flex-col gap-10 p-4 rounded-2xl w-full">
                            <div class="space-y-2">
                                <x-logo type="icon" />
                                <h3 class="font-semibold text-lg max-w-52">{{ __('pages/login.greeting') }}</h3>
                            </div>
                            <livewire:login />
                        </div>
                    </div>
                </div>
            </x-modal>
        @endif
    @endif
</div>
