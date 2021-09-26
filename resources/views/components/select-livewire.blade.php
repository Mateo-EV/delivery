@props(['model', 'value', 'disabled' => null])

<x-jet-label value="{{ $value }}" for="{{ $model }}" />
@error($model)
    <select class="jet-input block mt-1 w-full error" {{ $disabled ? 'disabled' : '' }} wire:model.defer="{{ $model }}">
        {{ $slot }}
    </select>
@else
    <select class="jet-input block mt-1 w-full" {{ $disabled ? 'disabled' : '' }} wire:model.defer="{{ $model }}">
        {{ $slot }}
    </select>
@enderror
<x-jet-input-error for="{{ $model }}" class="mt-2"/>