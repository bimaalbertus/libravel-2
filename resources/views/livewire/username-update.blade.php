<div>
    <form wire:submit.prevent="save">
        <div class="py-4 px-6">
            <h2 class="font-bold text-xl mb-4">{{ __('profile.username') }}</h2>
            <p class="text-sm mb-4">{{ __('profile.username_description_admin') }}</p>
            <x-input type="text" wire:model="username" name="username" :error="$errors->first('username')" width="w-full" />
        </div>
        <div class="flex w-full items-center justify-between py-4 px-6 border-t border-black/30 dark:border-white/30">
            <p class="text-sm text-black/50 dark:text-white/50">{{ __('profile.username_rule') }}</p>
            <x-button type="submit" width="w-16" height="h-8">
                {{ __('profile.save') }}
            </x-button>
        </div>
    </form>
</div>
