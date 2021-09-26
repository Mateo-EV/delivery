@props(['id' => null, 'maxWidth' => null, 'color'=> null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 {{ $color }}">
        <div class="text-lg text-white">
            {{ $title }}
        </div>
    </div>

    <div class="px-6 py-4">
        <div class="mt-4 overflow-hidden">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
