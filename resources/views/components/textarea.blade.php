@props([
    'name',
    'label' => '',
    'value' => '',
    'width' => 'w-full',
    'height' => 'h-full',
    'error' => false,
    'required' => true,
    'labelClass' => '',
    'parentClass' => '',
])

<div class="{{ $parentClass }}">
    @if ($label)
        <label for="{{ $name }}"
            class="{{ $labelClass }} block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        class="block {{ $width }} {{ $height }} px-2.5 py-2.5 leading-7 text-sm font-normal 
            shadow-xs text-neutral-900 dark:text-neutral-100 bg-transparent 
            border border-black/30 dark:border-white/30 rounded-lg 
            placeholder-neutral-400 focus:border-none
            focus:outline-none transition-all duration-300
            @error($name) 
                border-red-500 ring-2 ring-red-500 ring-opacity-50 outline-none 
            @enderror"
        {!! $attributes->merge(['class' => '']) !!} {{ $attributes }} @if ($required) required @endif></textarea>
    @if ($error)
        <small class="pl-0.5 text-red-500">{{ $error }}</small>
    @endif
</div>
