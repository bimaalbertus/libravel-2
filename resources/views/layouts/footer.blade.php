<div
    class="flex flex-col md:flex-row items-center justify-center md:justify-between gap-8 px-12 py-8 max-w-7xl w-full mt-52 bg-neutral-600/40 backdrop-blur-lg rounded-2xl shadow-2xl text-dark-text-primary">
    <div class="block md:hidden mb-8">
        <x-theme-toggle />
    </div>
    <div class="flex flex-col items-center text-center md:items-start md:text-justify gap-4">
        <div class="flex items-center gap-4">
            <a href="/" class="hover:scale-105 transition ease-in-out">
                <x-logo />
            </a>
            <div class="h-4 w-1 border-r border-white/50"></div>
            <div class="text-sm text-neutral-200 font-euclid-circular-b">
                {{ __('navigation/navigation.footer.project_created_with') }}
                <span class="text-pink-500">♥</span> {{ __('navigation/navigation.footer.by') }}
                <span class="text-neutral-200 font-bold">
                    ABPI
                </span>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <div class="text-neutral-200 font-euclid-circular-b">
                {{ __('navigation/navigation.footer.powered_by') }}
                <x-link-preview url="https://laravel.com/" class="text-neutral-200">
                    <strong>{{ __('navigation/navigation.footer.laravel') }}</strong>,
                </x-link-preview>
                <x-link-preview url="https://filamentphp.com/" class="text-neutral-200">
                    <strong>{{ __('navigation/navigation.footer.filament') }}</strong>,
                </x-link-preview>
                <x-link-preview url="https://laravel-livewire.com/" class="text-neutral-200">
                    <strong>{{ __('navigation/navigation.footer.livewire') }}</strong>,
                </x-link-preview>
                <x-link-preview url="https://tailwindcss.com" class="text-neutral-200">
                    <strong>{{ __('navigation/navigation.footer.tailwind') }}</strong>,
                </x-link-preview>
                {{ ' ' . __('navigation/navigation.footer.and') }}
                <x-link-preview url="https://alpinejs.dev/" class="text-neutral-200">
                    <strong>{{ __('navigation/navigation.footer.alpine') }}</strong>
                </x-link-preview>
            </div>
            <p class="text-neutral-200 font-euclid-circular-b">
                {{ __('navigation/navigation.footer.rights_reserved') }}
            </p>
        </div>
    </div>
    <div class="hidden md:block">
        <x-theme-toggle />
    </div>
</div>
