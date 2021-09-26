@props(['model'])

<x-jet-label value="{{ $slot }}" for="{{ $model }}" />
@error($model)
    <x-jet-input type="text" class="block mt-1 w-full error" wire:model.defer="{{ $model }}" {{ $attributes }} />
@else
    <x-jet-input type="text" wire:model.defer="{{ $model }}" class="block mt-1 w-full" {{ $attributes }} />
@enderror
<x-jet-input-error for="{{ $model }}" class="mt-2"/>