<div>
    <form wire:submit.prevent="save">
        <div class="py-4 px-6">
            <h2 class="font-bold text-xl mb-4">{{ __('profile.fullname') }}</h2>
            <p class="text-sm mb-4">{{ __('profile.fullname_description') }}</p>
            <x-input type="text" wire:model="fullname" name="fullname" :error="$errors->first('fullname')" />
        </div>
        <div class="flex w-full items-center justify-between py-4 px-6 border-t border-black/30 dark:border-white/30">
            <p class="text-sm text-black/50 dark:text-white/50">{{ __('profile.fullname_rule') }}</p>
            <button type="submit"
                class="inline-flex items-center justify-center w-16 h-8 shadow-sm rounded-lg bg-dark-bg dark:bg-light-bg hover:bg-opacity-80 dark:hover:bg-opacity-80 transition-all duration-300 text-white dark:text-black text-base font-medium font-product-sans leading-7">
                <span class="text-sm" wire:loading.remove wire:target="save">{{ __('profile.save') }}</span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <i class="ti ti-loader animate-spin"></i>
                </span>
            </button>
        </div>
    </form>
</div>
