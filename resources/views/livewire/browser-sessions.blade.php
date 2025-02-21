<div x-data="{ open: false }">
    <div>
        <div class="pt-4 px-6 max-w-2xl text-sm text-gray-200">
            <p>{{ __('profile.browser_sessions_content') }}</p>
        </div>

        <div class="px-6 pb-4 mt-5 space-y-6">
            @foreach ($sessions as $session)
                <div class="flex items-center">
                    <div>
                        @if ($session->agent['device'] === 'desktop')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        @elseif ($session->agent['device'] === 'mobile')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        @elseif ($session->agent['device'] === 'iphone')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        @elseif ($session->agent['device'] === 'tablet' || $session->agent['device'] === 'ipad')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                    transform="rotate(90 12 12)" />
                            </svg>
                        @endif
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-200">
                            {{ $session->agent['platform'] }} - {{ $session->agent['browser'] }}
                        </div>

                        <div class="text-xs text-gray-400">
                            {{ $session->ip_address }}

                            @if ($session->is_current_device)
                                <span
                                    class="text-blue-500 font-semibold ml-1">{{ __('profile.browser_sessions_device') }}</span>
                            @else
                                <span class="ml-1">{{ __('profile.browser_sessions_last_active') }}
                                    {{ $session->last_active }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($sessions) > 1)
            <div class="mt-10 border-t border-black/30 dark:border-white/30"></div>
            <div class="flex w-full items-center justify-end pb-4 px-6 mt-6">
                <x-button bg-color="bg-red-500" hover-color="hover:bg-red-600" text-color="text-white" width="w-56"
                    :loading="false" height="h-8" @click="open = !open">
                    {{ __('profile.browser_sessions_log_out') }}
                </x-button>
            </div>
        @endif
    </div>

    <x-modal type="new" open="open" :title="__('profile.browser_sessions_log_out')" :header="true">
        <x-slot name="body">
            <p class="text-sm text-gray-900">
                {{ __('profile.browser_sessions_confirm_pass') }}
            </p>

            <div class="mt-4">
                <x-input type="text" wire:model.defer="password" name="password" :error="$errors->first('password')" width="full"
                    label="Password" required />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button type="button" @click="open = false" :loading="false">
                {{ __('profile.cancel') }}
            </x-button>
            <x-button bgColor="bg-red-600 hover:opacity-80 transition ease-in-out"
                textColor="text-white dark:text-white" width="w-64" :loading="true"
                wire:target="logoutOtherBrowserSessions" wire:click="logoutOtherBrowserSessions">
                {{ __('profile.browser_sessions_log_out') }}
            </x-button>
        </x-slot>
    </x-modal>
</div>
