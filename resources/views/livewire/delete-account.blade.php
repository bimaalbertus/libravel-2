<div x-data="{ open: @entangle('isOpen') }">
    @if (\App\Models\User::where('is_admin', true)->count() > 1)
        <x-button bg-color="bg-red-500" hover-color="hover:bg-red-600" text-color="text-white" width="w-52" height="h-8"
            @click="open = true" :loading="false">
            {{ __('profile.delete_account') }}
        </x-button>
    @else
        <x-button bg-color="bg-red-600 opacity-50 cursor-not-allowed" hover-color="hover:bg-red-600"
            text-color="text-white" width="w-full px-2" height="h-8" :loading="false" :disabled="true">
            {{ __('profile.cannot_delete_last_admin') }}
        </x-button>
    @endif

    <x-modal type="new" open="open" :title="__('profile.are_you_sure')" :header="true">
        <x-slot name="body">
            <p class="text-sm text-gray-900">
                {{ __('profile.delete_account_card_description') }}
            </p>

            <div class="mt-4">
                <x-input type="password" wire:model="password" name="password" :error="$errors->first('password')" width="w-full"
                    label="Password" :required="false" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button type="button" @click="open = false" :loading="false">
                {{ __('profile.cancel') }}
            </x-button>
            <x-button bgColor="bg-red-600 hover:opacity-80 transition ease-in-out"
                textColor="text-white dark:text-white" width="w-32" :loading="true" wire:target="submit"
                wire:click="submit">
                {{ __('profile.submit') }}
            </x-button>
        </x-slot>
    </x-modal>
</div>
