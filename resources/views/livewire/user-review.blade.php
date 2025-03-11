<div x-data="{ ratingOpen: @entangle('ratingOpen') }" class="flex flex-col">
    @if ($user)
        <div class="mb-16">
            @if (\App\Models\UserReview::where('book_id', $book_id)->where('user_id', auth()->id())->first())
                <div class="flex flex-col border-2 border-neutral-500 p-4 rounded-xl">
                    <div class="flex justify-between">
                        <h1 class="font-semibold text-xl mb-2 capitalize">{{ __('review.your_review') }}:</h1>
                        <div>
                            <x-button wire:click="deleteReview" class="p-2" width="w-42"><i class="ti ti-trash"></i>
                                {{ __('filament-actions::delete.single.label') }}</x-button>
                            <x-button @click="ratingOpen = !ratingOpen" class="p-2" width="w-42"><i
                                    class="ti ti-edit"></i>
                                {{ __('filament-actions::edit.single.label') }}</x-button>
                        </div>
                    </div>

                    <div>
                        <x-rating :rate="$userReview->rating" :scale="5" />
                        @if ($userReview->review_text)
                            <p class="mt-8 text-sm capitalize">{{ __('review.label') }}:</p>
                            <p>{{ $userReview->review_text }}</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="flex justify-between">
                    <h1 class="font-semibold text-xl mb-2 capitalize">{{ __('review.your_review') }}:</h1>
                    <div>
                        <x-button @click="ratingOpen = !ratingOpen" class="p-2 capitalize" width="w-42"><i
                                class="ti ti-pencil-plus mr-1"></i>
                            {{ __('review.write') }}</x-button>
                    </div>
                </div>
                <p>{{ __('review.no_review') }}.</p>
            @endif

            <x-modal open="ratingOpen" :closeIcon="false">
                <div class="p-4 bg-light-bg-secondary dark:bg-dark-bg-secondary rounded-xl">
                    <livewire:user-review-form :bookId="$book_id" :bookSlug="$book_slug" />
                </div>
            </x-modal>
        </div>
    @endif

    <div>
        <h1 class="font-semibold text-xl capitalize">{{ __('review.user_review') }}:</h1>
        @forelse ($reviews as $review)
            <div class="p-4 mb-8">
                <div class="flex items-start gap-2">
                    {!! $user->getAvatar(40, 'circle') !!}
                    <div class="flex flex-col">
                        <span class="text-sm">{{ $review->user->username }}</span>
                        <span
                            class="text-xs font-semibold text-black/40 dark:text-white/40">{{ \App\Helpers\TimeHelper::timeAgo($review->created_at) }}</span>
                    </div>
                    <div class="ml-auto">
                        <x-rating :rate="$review->rating" :scale="5" />
                    </div>
                </div>

                <p class="mt-4 text-justify">{{ $review->review_text }}</p>
            </div>
        @empty
            <p class="text-gray-500">{{ __('review.no_review') }}.</p>
        @endforelse
    </div>
</div>
