<div class="flex flex-col gap-8 p-4 ">
    <div
        class="flex flex-col w-full border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
        <div class="w-full py-4 px-6">
            <h2 class="font-bold text-xl mb-4">
                {{ $user->isAdmin() ? __('profile.delete_account') : __('profile.request_delete_account') }}</h2>
            <p class="text-sm">{{ __('profile.delete_account_description') }}</p>
        </div>
        <div class="flex w-full items-center justify-end py-3 px-6 bg-red-400/30 dark:bg-red-400/10">
            @if ($user->isAdmin())
                <livewire:delete-account />
            @else
                <livewire:request-account-deletion />
            @endif
        </div>
    </div>
</div>
