@props([
    'user' => $user,
    'type' => 'square',
    'size' => 35,
])

@if ($user->avatar && $user->avatar->getFirstMediaUrl('avatars'))
    <img src="{{ $user->getAvatar() }}" alt="Avatar" {{ $attributes }}
        class="{{ $type === 'circle' ? 'rounded-full' : '' }}"
        style="width: {{ $size }}px; height: {{ $size }}px;" />
@else
    {!! $user->getAvatar($size, $type) !!}
@endif
