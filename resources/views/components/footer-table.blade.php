<div class="flex flex-col justify-between sm:flex-row mt-4">
    <div class="mb-4 sm:mb-0">
        <span>Mostrar</span>
        <select class="jet-input" wire:model="length">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>entradas</span>
    </div>
    {{ $slot }}
</div>