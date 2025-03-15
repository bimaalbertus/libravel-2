@props([
    'title' => '',
    'message' => '',
])
<div role="alert"
    {{ $attributes->merge(['class' => 'flex items-center gap-2 bg-red-600/20 border-2 border-red-400 text-red-500 dark:text-white px-2 py-1 rounded-lg relative text-sm']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
        <path d="M12 8v4" />
        <path d="M12 16h.01" />
    </svg>

    @if (strlen($title))
        <strong class="font-bold">{{ $title }}</strong>
    @endif
    @if ($message)
        <span class="block sm:inline">{{ $message }}</span>
    @endif
</div>
