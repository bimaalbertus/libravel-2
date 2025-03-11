<div x-data="{
    rating: $wire.rating,
    hoverRating: 0,
    ratings: [0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
    rate(rating) {
        $wire.updateRating(rating);
        this.rating = rating;
    }
}">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('review.give_rating_and_review') }}</h3>

        <!-- Star Rating -->
        <div class="flex items-center mb-2">
            <div class="flex items-center space-x-1">
                <template x-for="(star, index) in 5" :key="index">
                    <div class="relative">
                        <!-- Full star background (always visible) -->
                        <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>

                        <!-- Left Half Star (0.5, 1.5, 2.5, etc.) -->
                        <div class="absolute top-0 left-0 overflow-hidden"
                            :style="{
                                width: ((hoverRating || rating) >= index + 0.5 && (hoverRating || rating) < index + 1) ?
                                    '50%' : '0%'
                            }">
                            <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>

                        <!-- Full Star (1, 2, 3, etc.) -->
                        <div class="absolute top-0 left-0 overflow-hidden"
                            :style="{ width: (hoverRating || rating) >= index + 1 ? '100%' : '0%' }">
                            <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>

                        <!-- Interactive Areas -->
                        <div class="absolute top-0 left-0 w-1/2 h-full cursor-pointer" @click="rate(index + 0.5)"
                            @mouseenter="hoverRating = index + 0.5" @mouseleave="hoverRating = 0"></div>
                        <div class="absolute top-0 right-0 w-1/2 h-full cursor-pointer" @click="rate(index + 1)"
                            @mouseenter="hoverRating = index + 1" @mouseleave="hoverRating = 0"></div>
                    </div>
                </template>
            </div>
            <span class="ml-2 text-gray-700"
                x-text="rating ? rating.toFixed(1) + ' {{ __('review.out_of') }} 5' : $el.dataset.noRating"
                data-no-rating="{{ __('review.no_rating') }}"></span>
        </div>

        <!-- Review Textarea -->
        <div class="mt-8 mb-4">
            <x-textarea wire:model.defer="reviewText" name="reviewText" :error="$errors->first('reviewText')" width="w-full"
                labelClass="capitalize" label="{{ __('review.your_review') }}" required />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center">
            <x-button wire:click="saveRating" x-on:click="openRating = false" :loading="true" class="p-2"
                width="w-42">
                {{ $hasReviewed ? __('review.edit_review') : __('profile.submit') }}</x-button>

            <div x-show="rating > 0 && $wire.hasReviewed" class="text-sm text-gray-600">
                {{ __('review.last_review') }}: <span class="font-medium" x-text="$wire.savedRating.toFixed(1)"></span>
                {{ __('review.star') }}
            </div>
        </div>
    </div>
</div>
