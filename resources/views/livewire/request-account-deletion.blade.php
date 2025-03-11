<div x-data="{ open: @entangle('isOpen') }">
    @if (!$user->messages()->where('type', 'delete_account')->where('status', 'pending')->exists())
        <x-button bg-color="bg-red-500" hover-color="hover:bg-red-600" text-color="text-white" width="w-52" height="h-8"
            @click="open = true" :loading="false">
            {{ __('profile.request_delete_account') }}
        </x-button>
    @else
        <x-button bg-color="bg-red-600 opacity-50 cursor-not-allowed" hover-color="hover:bg-red-600"
            text-color="text-white" width="w-96" height="h-8" :loading="false" :disabled="true">
            {{ __('profile.account_deletion_request_already_exists') }}
        </x-button>
    @endif

    <x-modal type="new" open="open" :title="__('profile.are_you_sure')" :header="true">
        <x-slot name="body">
            <p class="text-sm text-gray-900">
                {{ __('profile.delete_account_card_description') }}
            </p>

            <div class="mt-4">
                <x-textarea wire:model.defer="reason" name="reason" :error="$errors->first('reason')" width="w-full" label="Reason"
                    required />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button type="button" @click="open = false" :loading="false">
                {{ __('profile.cancel') }}
            </x-button>
            <x-button bgColor="bg-red-600 hover:opacity-80 transition ease-in-out"
                textColor="text-white dark:text-white" width="w-32" :loading="true" wire:target="requestDeletion"
                wire:click="requestDeletion">
                {{ __('profile.submit') }}
            </x-button>
        </x-slot>
    </x-modal>
</div>
