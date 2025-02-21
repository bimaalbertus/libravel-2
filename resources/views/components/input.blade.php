@props([
    'name',
    'label' => '',
    'value' => '',
    'type' => 'text',
    'width' => '96',
    'height' => '10',
    'error' => false,
    'required' => true,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        class="block w-{{ $width }} h-{{ $height }} px-2.5 py-2.5 leading-7 text-sm font-normal 
            shadow-xs text-neutral-900 dark:text-neutral-100 bg-transparent 
            border border-black/30 dark:border-white/30 rounded-lg 
            placeholder-neutral-400 focus:border-none
            focus:outline-none transition-all duration-300
            @error($name) 
                border-red-500 ring-2 ring-red-500 ring-opacity-50 outline-none 
            @enderror"
        {!! $attributes->merge(['class' => '']) !!} {{ $attributes }} @if ($required) required @endif>
    @if ($error)
        <small class="pl-0.5 text-red-500">{{ $error }}</small>
    @endif
</div>
