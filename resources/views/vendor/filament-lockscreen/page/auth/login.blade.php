<div>
    <x-filament-panels::layout.base :livewire="$this">
        @props([
            'after' => null,
            'heading' => null,
            'subheading' => null,
        ])

        <img src="/gradients/docs-left.png"
            class="hidden dark:block fixed -left-32 w-[65rem] opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none transition-transform-opacity motion-reduce:transition-none !duration-300 rounded-large"
            alt="docs left background" data-loaded="true" />
        <img src="/gradients/docs-right.png"
            class="hidden dark:block fixed -right-96 -top-72 w-[75rem] rotate-180 opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none transition-transform-opacity motion-reduce:transition-none !duration-300 rounded-large"
            alt="docs right background" data-loaded="true" />

        <div class="fi-simple-layout flex min-h-screen flex-col items-center z-[999]">
            <div
                class="fi-simple-main-ctn flex flex-col gap-4 w-full max-w-md flex-grow items-center justify-center z-[999]">
                <main
                    class="fi-simple-main w-full bg-white dark:bg-neutral-900/30 p-6 shadow-2xl shadow-neutral-500 dark:shadow-black sm:max-w-lg sm:rounded-xl">
                    {{-- Slot --}}
                    <div class="flex flex-col items-center gap-8">
                        <h1 class="font-bold text-2xl">{{ __('filament-lockscreen::default.user_menu_title') }}</h1>
                        <img class="w-12 h-12 rounded-full"
                            src="{{ \Filament\Facades\Filament::getUserAvatarUrl(\Filament\Facades\Filament::auth()->user()) }}"
                            alt="avatar">
                    </div>
                    <div class="flex flex-row justify-center mt-3 mb-8">
                        <div class="font-semibold dark:text-white">
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
