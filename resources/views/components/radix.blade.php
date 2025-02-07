<style>
    .radix-icons svg {
        width: {{ $size }}px;
        height: {{ $size }}px;
    }
</style>

<span class="{{ $class ?? '' }} radix-icons inline-flex items-center justify-center">
    {!! file_get_contents("icons/radix/$name.svg") !!}
</span>
