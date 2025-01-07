<div>
    <x-filament-panels::layout.base :livewire="$this">
        @props([
            'after' => null,
            'heading' => null,
            'subheading' => null,
        ])

        <div class="fi-simple-layout flex min-h-screen flex-col items-center">
            <div class="fi-simple-main-ctn flex flex-col gap-4 w-full max-w-md flex-grow items-center justify-center">
                <main
                    class="fi-simple-main w-full bg-white p-6 shadow-2xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:max-w-lg sm:rounded-xl">
                    {{-- Slot --}}
                    <div class="flex flex-col items-center gap-8">
                        <img class="w-56 h-56 rounded-full"
                            src="{{ \Filament\Facades\Filament::getUserAvatarUrl(\Filament\Facades\Filament::auth()->user()) }}"
                            alt="avatar">
                    </div>
                    <div class="flex flex-row justify-center">
                        <div class="font-medium dark:text-white">
                            <div>{{ \Filament\Facades\Filament::auth()->user()?->name ?? '' }}</div>
                        </div>
                    </div>

                    <x-filament-panels::form wire:submit="authenticate">
                        {{ $this->form }}

                        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
                    </x-filament-panels::form>
                    <div class="text-center">
                        <form id="logout-form" action="{{ url(filament()->getLogoutUrl()) }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </main>
                <x-filament::link>
                    <a class="text-primary-600 hover:text-primary-700" href="#!"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('filament-lockscreen::default.button.switch_account') }}</a>
                </x-filament::link>
            </div>
        </div>
    </x-filament-panels::layout.base>
</div>
