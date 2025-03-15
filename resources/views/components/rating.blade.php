@props([
    'isDummy' => false,
    'scale' => 5,
    'rate' => null,
])

@php
    $maxStars = $scale;
    $normalizedRating = $scale > 0 ? ($rate / $scale) * $maxStars : 0;
    $fullStars = floor($normalizedRating);
    $hasHalfStar = $normalizedRating - $fullStars >= 0.5;
    $emptyStars = $maxStars - ($fullStars + ($hasHalfStar ? 1 : 0));
@endphp

@if ($attributes->has('isDummy'))
    @for ($i = 0; $i < $maxStars; $i++)
        <svg class="w-6 h-6" fill="rgb(107, 114, 128)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
        </svg>
    @endfor
@else
    <div class="flex items-center">
        <!-- Bintang penuh -->
        @for ($i = 0; $i < $fullStars; $i++)
            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
            </svg>
        @endfor

        <!-- Bintang setengah (jika ada) -->
        @if ($hasHalfStar)
            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <!-- Pastikan id gradient unik, misalnya dengan menggabungkan $rate dan $scale -->
                    <linearGradient id="half-star-{{ $rate }}-{{ $scale }}">
                        <stop offset="50%" stop-color="currentColor" />
                        <stop offset="50%" stop-color="rgb(107, 114, 128)" />
                    </linearGradient>
                </defs>
                <path fill="url(#half-star-{{ $rate }}-{{ $scale }})"
                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
            </svg>
        @endif

        <!-- Bintang kosong -->
        @for ($i = 0; $i < $emptyStars; $i++)
            <svg class="w-6 h-6" fill="rgb(107, 114, 128)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
            </svg>
        @endfor
    </div>
@endif
