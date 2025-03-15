@props([
    'user' => $user,
    'type' => 'square',
    'size' => 35,
])

@if ($user->avatar && $user->avatar->getFirstMediaUrl('avatars'))
    <img src="{{ $user->avatar->getFirstMediaUrl('avatars') }}" alt="Avatar" {{ $attributes }}
        class="{{ $type === 'circle' ? 'rounded-full' : '' }}"
        style="width: {{ $size }}px; height: {{ $size }}px;" />
@elseif($user->getFirstMediaUrl('user.avatar'))
    <img src="{{ $user->getFirstMediaUrl('user.avatar') }}" alt="Avatar" {{ $attributes }}
        class="{{ $type === 'circle' ? 'rounded-full' : '' }}"
        style="width: {{ $size }}px; height: {{ $size }}px;" />
@else
    {!! $user->getAvatar($size, $type) !!}
@endif
