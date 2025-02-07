@php
    $closeIcon;
    $blur = 'md';

    $positions = [
        'top' => 'top-[5rem] items-start',
        'center' => 'items-center',
        'bottom' => 'bottom-0 items-end',
    ];

    $blurs = [
        'none' => 'backdrop-blur-none',
        'sm' => 'backdrop-blur-small',
        'base' => 'backdrop-blur',
        'md' => 'backdrop-blur-md',
        'lg' => 'backdrop-blur-lg',
        'xl' => 'backdrop-blur-xl',
    ];

    $positionClass = $positions[$position] ?? 'items-center';
    $closeIconClass = $closeIcon === false ? 'hidden' : 'block';
    $blurClass = $blurs[$blur] ?? $blur['lg'];

    $enterStartClass = $position === 'bottom' ? 'translate-y-8' : '-translate-y-8';
    $leaveEndClass = $position === 'bottom' ? 'translate-y-8' : '-translate-y-8';
@endphp

<div x-show="{{ $open ?? 'isOpen' }}" x-cloak x-transition.opacity.duration.200ms x-init="$watch('{{ $open ?? 'isOpen' }}', value => { document.body.classList.toggle('overflow-hidden', value) })"
    @keydown.esc.window="{{ $open ?? 'isOpen' }} = false" @click.self="{{ $open ?? 'isOpen' }} = false"
    class="fixed inset-0 z-[30] flex {{ $positionClass }} justify-center">

    <div x-show="{{ $open ?? 'isOpen' }}" x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-gray-500 {{ $blurClass }} dark:bg-dark-bg dark:bg-opacity-75 bg-opacity-75"
        @click="{{ $open ?? 'isOpen' }} = !{{ $open ?? 'isOpen' }}"></div>

    <i class="ti ti-x cursor-pointer text-5xl absolute right-4 top-24 {{ $closeIconClass }}"
        @click="{{ $open ?? 'isOpen' }} = !{{ $open ?? 'isOpen' }}"></i>

    <div x-show="{{ $open ?? 'isOpen' }}" x-cloak
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 {{ $enterStartClass }}" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 {{ $enterStartClass }}" class="relative overflow-auto z-[40]">
        {{ $slot }}
    </div>
</div>
