@props(['links' => []])

<div class="flex flex-row md:flex-col gap-4 w-full px-8 text-lg text-black/50 dark:text-white/50">
    @foreach ($links as $link)
        <a href="{{ $link['url'] }}" @class([
            'font-bold text-black dark:text-white' => Request::is($link['active']),
        ])>
            {{ $link['label'] }}
        </a>
    @endforeach
</div>
