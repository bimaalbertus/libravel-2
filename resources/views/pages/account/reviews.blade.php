@php
    $reviews = \App\Models\UserReview::where('user_id', $user->id)->paginate(5);
@endphp

<div x-data="{ deleteModal: false }" {{ $attributes->merge(['class' => 'w-full gap-4']) }}>
    <h1 class="font-bold text-xl capitalize mb-8">{{ __('review.your_reviews') }}:</h1>
    @if (count($reviews) > 0)
        @foreach ($reviews as $review)
            <div class="p-4 mb-8 border rounded-lg border-black/20 dark:border-white/20">
                <div class="flex flex-col">
                    <span data-href="{{ route('book.detail', [$review->book->id, $review->book->slug]) }}"
                        data-target="_blank"
                        class="inline-flex items-center font-semibold text-lg hover:underline cursor-pointer">{{ $review->book->title }}
                        <i class="ti ti-external-link ml-auto"></i></span>
                    <span
                        class="text-xs font-semibold text-black/40 dark:text-white/40">{{ \App\Helpers\TimeHelper::timeAgo($review->created_at) }}</span>
                </div>
                <div class="my-4">
                    <x-rating :rate="$review->rating" :scale="5" />
                </div>

                <x-show-more :text="$review->review_text" class="text-justify" />
                @if (!$review->isVisible())
                    <x-alert :message="__('review.review_hidden')" class="mt-8 max-w-lg" />
                @endif
            </div>
        @endforeach
    @else
        <p class="text-center text-neutral-500">{{ __('review.haven\'t_review_any') }}.</p>
    @endif
    {{ $reviews->links('pagination.paginator') }}
</div>
