<div class="max-w-xl text-sm text-gray-200">
    <p>{{ __('profile.browser_sessions_content') }}</p>
</div>

<!-- Sessions List -->
<div class="mt-5 space-y-6">
    @foreach ($sessions as $session)
        <div class="flex items-center">
            <div>
                @if ($session->agent['device'] === 'desktop')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
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

    <!-- Log Out Form -->
    <div class="mt-10">
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-medium text-gray-200">
                    {{ __('profile.browser_sessions_log_out') }}
                </h3>

                <p class="mt-2 text-sm text-gray-200">
                    {{ __('profile.browser_sessions_confirm_pass') }}
                </p>
            </div>

            <form method="POST" action="{{ route('settings.logout-other') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="block mt-4 w-full h-10 px-2.5 py-2.5 leading-7 text-sm font-normal shadow-xs text-gray-900 dark:text-gray-100 bg-transparent border border-black/30 dark:border-white/30 rounded-lg placeholder-gray-400 focus:outline-[#0D6CFD] focus:border-none focus:outline-none focus transition-shadow duration-300">

                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                        {{ __('profile.browser_sessions_log_out') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
