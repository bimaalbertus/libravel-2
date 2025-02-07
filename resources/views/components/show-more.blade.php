<div x-data="{ expanded: false }" class="relative">
    <p class="text-md max-w-3xl text-justify">
        <span x-show="!expanded">
            {!! Str::limit($text, $limit) !!}
            @if (strlen($text) >= $limit)
                <span @click="expanded = true" class="text-[#87A2FF] hover:underline inline cursor-pointer">
                    ...Show More
                </span>
            @endif
        </span>
        <span x-show="expanded">
            {!! $text !!}
            <span @click="expanded = false" class="text-[#87A2FF] hover:underline inline cursor-pointer">
                Show Less
            </span>
        </span>
    </p>
</div>
