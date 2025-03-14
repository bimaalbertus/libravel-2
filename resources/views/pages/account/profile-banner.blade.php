@php
    $majors = \App\Models\Major::all();
@endphp

<div class="relative w-full text-light-text-primary dark:text-dark-text-primary">
    <!-- Banner Image with Gradient Overlay -->
    <div class="w-full h-72 overflow-hidden relative">
        <img src="/assets/lofi-bg.png" alt="Banner" class="w-full h-full object-cover rounded-xl opacity-70">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-light-bg-primary dark:from-dark-bg-primary to-transparent">
        </div>

        <!-- Joined and Edit buttons (top right) -->
        <div class="absolute top-4 right-4 flex items-center space-x-2">
            <div class="text-sm px-3 py-1 rounded-full bg-neutral-900 dark:bg-neutral-700 text-white bg-opacity-80">
                {{ __('profile.joined') . ' ' . $joined }}
            </div>
            <x-button bgColor="bg-yellow-500" x-on:click="selectedTab = 'account'">
                <i class="ti ti-edit"></i>
                Edit
            </x-button>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Profile Info Section (horizontal layout) -->
        <div class="relative -mt-16">
            <!-- Profile and Details in Row Layout -->
            <div class="flex items-start space-x-4">
                <!-- Profile Picture -->
                <div
                    class="group h-36 w-36 rounded-md overflow-hidden border-4 border-light-bg-primary dark:border-dark-bg-primary">
                    <x-avatar-display size="144" />
                    <div x-on:click="selectedTab = 'account'"
                        class="absolute inset-0 size-36 bg-black/50 dark:bg-black/70 text-white flex justify-center items-center rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                        <i class="ti ti-camera text-3xl"></i>
                    </div>
                </div>

                <!-- User Info -->
                <div class="pb-4 max-w-xl">
                    <p class="text-light-text-secondary dark:text-dark-text-secondary text-sm">
                        {{ $user->username }}
                    </p>
                    <h1 class="text-2xl font-semibold">{{ $user->fullname ?? $user->username }}</h1>

                    <div class="flex space-x-2 mt-2">
                        @if ($user->status)
                            <span class="font-medium">{{ __("members/fields.fields.status.$user->status") }}</span>
                        @endif
                        @if ($user->gender)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium">{{ __("members/fields.fields.gender.$user->gender") }}</span>
                        @endif
                        @if ($user->major)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium capitalize">
                                {{ $userMajor }}
                            </span>
                            <span class="font-bold mx-2">•</span>
                        @elseif ($user->isAdmin())
                            <span class="font-medium">{{ $user->isAdmin() ? 'Admin' : '' }}</span>
                        @endif
                    </div>
                    @if ($user->bio)
                        <x-show-more :text="$user->bio" />
                    @endif
                </div>
            </div>

            <x-account::reviews class="mt-8" />
        </div>
    </div>
</div>
