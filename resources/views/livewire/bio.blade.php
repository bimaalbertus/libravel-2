<div>
    <form wire:submit.prevent="save">
        <div class="py-4 px-6">
            <h2 class="font-bold text-xl mb-4">{{ __('profile.bio.label') }}</h2>
            <p class="text-sm mb-4">{{ __('profile.bio.desc') }}</p>
            <x-textarea wire:model="bio" name="bio" :error="$errors->first('bio')" width="w-full" :required="false" />
        </div>
        <div class="flex w-full items-center justify-between py-4 px-6 border-t border-black/30 dark:border-white/30">
            <p class="text-sm text-black/50 dark:text-white/50">{{ __('profile.bio.rule') }}</p>
            <x-button type="submit" :loading="true" width="w-16" height="h-8">
                {{ __('profile.save') }}
            </x-button>
        </div>
    </form>
</div>
