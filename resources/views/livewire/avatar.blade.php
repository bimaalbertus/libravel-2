<div x-data="{
    openAvatar: @entangle('openAvatar'),
}">
    <div class="flex w-full justify-between py-4 px-6 border-b border-black/30 dark:border-white/30">
        <div>
            <h2 class="font-bold text-xl mb-4">Avatar</h2>
            <p class="text-sm mb-4">{{ __('profile.avatar.avatar_desc') }}</p>
        </div>
        <div class="group relative">
            <x-avatar-display type="circle" :size="96" />
            <div @click="openAvatar = true"
                class="absolute inset-0 size-24 bg-black/50 dark:bg-neutral-800/70 text-white flex justify-center items-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                <i class="ti ti-camera text-3xl"></i>
            </div>
        </div>
    </div>
    <p class="py-4 px-6 text-black/50 dark:text-white/50 text-sm">{{ __('profile.avatar.avatar_helper') }}</p>

    <x-modal open="openAvatar" :closeIcon="false" blur="none">
        <div x-cloak
            class="overflow-y-auto bg-light-bg-secondary dark:bg-dark-bg-secondary border border-black/30 dark:border-white/30 rounded-xl w-full max-w-md md:max-w-full mx-auto">
            <h3 class="text-lg font-bold mb-4 min-w-40 p-6 capitalize">{{ __('profile.avatar.select') }}</h3>
            <div class="flex flex-col items-center max-h-96 overflow-y-auto p-6">
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 md:gap-8 mb-6">
                    @foreach ($avatars as $avatar)
                        <label class="block cursor-pointer" wire:click="$set('selectedAvatarId', {{ $avatar->id }})">
                            <input type="radio" name="avatar" value="{{ $avatar->id }}" x-model="selectedAvatar"
                                class="hidden">
                            <img src="{{ $avatar->getFirstMediaUrl('avatars') }}" alt="Avatar"
                                class="size-32 rounded-md object-cover cursor-pointer transition transform hover:scale-105 {{ $selectedAvatarId === $avatar->id ? 'ring-4 ring-offset-1 ring-blue-500' : '' }}">
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end gap-2 p-6">
                <x-button x-on:click="openAvatar = false" bg-color="bg-transparent" width="w-16"
                    class="border-2 border-neutral-600 text-black dark:text-white hover:opacity-60">{{ __('profile.cancel') }}</x-button>
                <x-button type="submit" wire:click="saveAvatar" width="w-16" height="h-8" :loading="true">
                    {{ __('profile.save') }}
                </x-button>
            </div>
        </div>
    </x-modal>
</div>
