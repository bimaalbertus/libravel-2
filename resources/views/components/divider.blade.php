{{-- resources/views/components/divider.blade.php --}}
@props([
    'position' => 'horizontal', // options: horizontal, vertical, top, right, bottom, left
    'width' => null,
    'height' => null,
    'borderWidth' => '1px',
    'borderStyle' => 'solid',
    'borderColor' => 'currentColor',
    'margin' => '1rem 0',
    'opacity' => '0.25',
    'rounded' => false,
])

@php
    // Set default width and height based on position
    if ($position === 'horizontal' || $position === 'top' || $position === 'bottom') {
        $width = $width ?? '100%';
        $height = $height ?? $borderWidth;
    } elseif ($position === 'vertical' || $position === 'left' || $position === 'right') {
        $width = $width ?? $borderWidth;
        $height = $height ?? '100%';
    }

    // Determine which border to display based on position
    $border = '';
    switch ($position) {
        case 'top':
            $border = "border-top: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
        case 'right':
            $border = "border-right: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
        case 'bottom':
            $border = "border-bottom: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
        case 'left':
            $border = "border-left: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
        case 'horizontal':
            $border = "border-top: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
        case 'vertical':
            $border = "border-left: {$borderWidth} {$borderStyle} {$borderColor};";
            break;
    }

    // Build the inline style string
    $style = "
        width: {$width};
        height: {$height};
        {$border}
        margin: {$margin};
        opacity: {$opacity};
    ";

    // Add rounded corners if specified
    if ($rounded) {
        $style .= 'border-radius: 9999px;';
    }
@endphp

<div {{ $attributes->merge(['class' => 'divider', 'style' => $style]) }}>
    {{ $slot }}
</div>
