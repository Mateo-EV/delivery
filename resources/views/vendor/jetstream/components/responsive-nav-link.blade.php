@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full px-4 py-2 block capitalize font-medium text-sm tracking-wide hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out text-main bg-main bg-opacity-25 border-l-4 border-main'
            : 'w-full px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
