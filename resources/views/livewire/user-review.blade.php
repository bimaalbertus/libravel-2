<div x-data="{ ratingOpen: @entangle('ratingOpen'), deleteModal: @entangle('deleteModal') }" class="flex flex-col">
    @if ($user)
        <div class="mb-16">
            @if (\App\Models\UserReview::where('book_id', $book_id)->where('user_id', auth()->id())->first())
                <div class="flex flex-col border-2 border-neutral-500 p-4 rounded-xl">
                    @if (!$userReview->isVisible())
                        <x-alert :message="__('review.review_hidden')" class="mb-8" />
                    @endif
                    <div class="flex justify-between">
                        <h1 class="font-semibold text-xl mb-2 capitalize">{{ __('review.your_review') }}:</h1>
                        <div>
                            <x-button x-on:click="deleteModal = !deleteModal" bgColor="bg-red-600"
                                class="text-black dark:text-white p-2" width="w-42"><i class="ti ti-trash"></i>
                                {{ __('filament-actions::delete.single.label') }}</x-button>
                            <x-button x-on:click="ratingOpen = !ratingOpen" class="p-2" width="w-42"><i
                                    class="ti ti-edit"></i>
                                {{ __('filament-actions::edit.single.label') }}</x-button>
                        </div>
                    </div>

                    <div>
                        <x-rating :rate="$userReview->rating" :scale="5" />
                        @if ($userReview->review_text)
                            <p class="mt-8 text-sm capitalize">{{ __('review.label') }}:</p>
                            <x-show-more isMarkdown :text="$userReview->review_text" class="text-justify" />
                        @endif
                    </div>
                </div>
                {{-- Delete Modal --}}
                <x-modal open="deleteModal" :closeIcon="false">
                    <div
                        class="flex flex-col mx-auto p-4 bg-light-bg-secondary dark:bg-dark-bg-secondary rounded-xl w-full max-w-96">
                        <button x-on:click="deleteModal = false" aria-label="close modal" class="ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="flex flex-col items-center gap-4 mx-auto">
                            <span
                                class="inline-flex items-center justify-center rounded-full size-12 bg-red-400/30 dark:bg-red-500/80">
                                <i class="ti ti-alert-triangle text-4xl text-red-600 dark:text-white"></i>
                            </span>
                            <h1 class="text-2xl font-semibold text-black dark:text-white">
                                {{ __('review.delete.delete_review') }}</h1>
                            <p class="text-center mt-4">{{ __('review.delete.confirm_delete_review') }}</p>
                            <div class="flex items-center gap-4 w-full">
                                <x-button x-on:click="deleteModal = false" bg-color="bg-transparent" width="w-full"
                                    class="border-2 border-neutral-600 text-black dark:text-white hover:opacity-60">{{ __('profile.cancel') }}</x-button>
                                <x-button wire:click="deleteReview" :loading="true" bg-color="bg-red-500"
                                    width="w-full"
                                    class="text-black dark:text-white hover:opacity-60">{{ __('profile.yes_delete_it') }}</x-button>
                            </div>
                        </div>
                    </div>
                </x-modal>
            @else
                <div class="flex justify-between">
                    <h1 class="font-semibold text-xl mb-2 capitalize">{{ __('review.your_review') }}:</h1>
                </div>
                <div class="flex flex-col gap-4 items-center justify-center mt-8">
                    <p>{{ __('review.haven\'t_review') }}.</p>
                    <x-button @click="ratingOpen = !ratingOpen" class="p-2 capitalize" width="w-42"><i
                            class="ti ti-pencil-plus mr-1"></i>
                        {{ __('review.write') }}</x-button>
                </div>
            @endif

            {{-- Rating Modal --}}
            <x-modal open="ratingOpen" :closeIcon="false">
                <livewire:user-review-form :bookId="$book_id" :bookSlug="$book_slug" :ratingOpen="$ratingOpen" />
            </x-modal>
        </div>
    @endif

    <div class="flex flex-col">
        <h1 class="font-semibold text-xl capitalize">{{ __('review.user_reviews') }}:</h1>
        @forelse ($reviews as $review)
            <div class="p-4 mb-8">
                <div class="flex items-start gap-2">
                    @if ($review->user->avatar && $review->user->avatar->getFirstMediaUrl('avatars'))
                        <img src="{{ $review->user->avatar->getFirstMediaUrl('avatars') }}" alt="Avatar"
                            class="rounded-full size-[35px]" />
                    @elseif($review->user->getFirstMediaUrl('user.avatar'))
                        <img src="{{ $review->user->getFirstMediaUrl('user.avatar') }}" alt="Avatar"
                            class="rounded-full size-[35px]" />
                    @else
                        {!! $review->user->getAvatar(35, 'circle') !!}
                    @endif
                    <div class="flex flex-col">
                        <span class="text-sm">{{ $review->user->username }}</span>
                        <span
                            class="text-xs font-semibold text-black/40 dark:text-white/40">{{ \App\Helpers\TimeHelper::timeAgo($review->created_at) }}</span>
                    </div>
                    <div class="ml-auto">
                        <x-rating :rate="$review->rating" :scale="5" />
                    </div>
                </div>

                <x-show-more isMarkdown :text="$review->review_text" class="text-justify mt-4" />
            </div>
        @empty
            <p class="text-gray-500 mx-auto mt-8">{{ __('review.no_review') }}.</p>
        @endforelse
    </div>
</div>
