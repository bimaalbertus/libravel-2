<div x-data="{ open: @entangle('isOpen') }">
    <div class="py-4 px-6">
        <h2 class="font-bold text-xl mb-4">{{ __('profile.username') }}</h2>
        <p class="text-sm">{{ __('profile.username_description') }}</p>
        <div
            class="flex justify-start items-center w-96 h-10 mt-4 p-2.5 border border-black/30 dark:border-white/30 rounded-md text-sm">
            <span>{{ $user->username }}</span>
        </div>
    </div>

    <div class="flex w-full items-center justify-end py-4 px-6 border-t border-black/30 dark:border-white/30">
        @if (!$user->messages()->where('type', 'change_username')->where('status', 'pending')->exists())
            <x-button width="w-44" height="h-8" @click="open = true" :loading="false">
                <i class="ti ti-bell"></i>
                {{ __('profile.notify_admin') }}
            </x-button>
        @else
            <x-button bg-color="bg-white opacity-50 cursor-not-allowed" hover-color="hover:bg-white"
                text-color="text-black" width="w-96" height="h-8" :loading="false" :disabled="true">
                {{ __('profile.username_request_already_exists') }}
            </x-button>
        @endif

        <x-modal type="new" open="open" :title="__('profile.username_request')" :header="true">
            <x-slot name="body">
                <p class="text-sm text-gray-900">
                    {{ __('profile.username_card_description') }}
                </p>

                <div class="flex flex-col gap-4 mt-4">
                    <x-input wire:model.defer="new_username" name="new_username" :error="$errors->first('new_username')" width="full"
                        label="{{ __('profile.new_username') }}" required />
                    <x-textarea wire:model.defer="reason" name="reason" :error="$errors->first('reason')" width="full"
                        label="{{ __('members/members-messages.fields.reason') }}" required />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button bgColor="bg-transparent border-2 border-black/40 dark:border-white/40 hover:opacity-70"
                    textColor="text-black dark:text-white" type="button" @click="open = false" :loading="false">
                    {{ __('profile.cancel') }}
                </x-button>
                <x-button bgColor="bg-dark-bg dark:bg-light-bg hover:opacity-80 transition ease-in-out"
                    textColor="text-white dark:text-black" width="w-32" :loading="true" wire:target="send"
                    wire:click="send">
                    {{ __('profile.submit') }}
                </x-button>
            </x-slot>
        </x-modal>
    </div>
</div>
