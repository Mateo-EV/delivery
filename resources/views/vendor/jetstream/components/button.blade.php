@props(["color"=>"bg-main"])

<button {{ $attributes->merge(['class' => 'jet-button '.$color]) }}>
    {{ $slot }}
</button>
