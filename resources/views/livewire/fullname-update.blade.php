<div>
    <form wire:submit.prevent="save">
        <div class="py-4 px-6">
            <h2 class="font-bold text-xl mb-4">{{ __('profile.fullname') }}</h2>
            <p class="text-sm mb-4">{{ __('profile.fullname_description') }}</p>
            <x-input type="text" wire:model="fullname" name="fullname" :error="$errors->first('fullname')" width="w-full" />
        </div>
        <div class="flex w-full items-center justify-between py-4 px-6 border-t border-black/30 dark:border-white/30">
            <p class="text-sm text-black/50 dark:text-white/50">{{ __('profile.fullname_rule') }}</p>
            <x-button type="submit" width="w-16" height="h-8" :loading="true">
                {{ __('profile.save') }}
            </x-button>
        </div>
    </form>
</div>
