<div>
    <form wire:submit.prevent="submit" class="w-full space-y-8">
        <div x-data class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
            <x-input type="text" wire:model="username" name="username" :error="$errors->first('username')" width="w-full" height="h-12"
                placeholder="Username" class="border-2" :required="false" />
        </div>

        <div class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
            <x-input type="password" wire:model="password" name="password" :error="$errors->first('password')" width="w-full"
                height="h-12" placeholder="Password" class="border-2" :required="false" />
        </div>

        <x-button type="submit" class="uppercase" width="w-full" height="h-12" :loading="true">
            {{ __('pages/login.action') }}
        </x-button>
    </form>
</div>
