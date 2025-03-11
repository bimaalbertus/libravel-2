<div x-data="{ isLoading: @entangle('isLoading') }">
    <button type="submit" wire:click="logout"
        class="inline-flex items-center justify-between w-full gap-2 cursor-pointer py-1 px-2 hover:bg-light-accent-secondary rounded-lg dark:hover:bg-dark-primary hover:text-white transition-all duration-100">
        <span>{{ __('navigation/navigation.menus.signout') }}</span>
        <i class="ti ti-logout mt-1 text-lg"></i>
    </button>

    <x-modal open="isLoading" :closeIcon="false">
        <div x-cloak
            class="flex flex-col items-center justify-center text-center space-y-4 p-6 text-black dark:text-white">
            <!-- Loading Spinner -->
            <i class="ti ti-loader text-xl animate-spin motion-reduce:animate-none"></i>
            <!-- Text -->
            <span class="text-lg font-medium">{{ __('navigation/navigation.loading') }}...</span>
        </div>
    </x-modal>
</div>
