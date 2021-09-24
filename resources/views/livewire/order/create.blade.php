<div>
    <button class="bg-main rounded p-2 text-white font-semibold block cursor-pointer z-10 px-3 mt-2" wire:click="$set('open', true)">Nuevo Pedido</button>
    <x-jet-dialog-modal wire:model="open" color="bg-main">
        <x-slot name="title">
            Nuevo Usuario
        </x-slot>
        <x-slot name="content">
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="code">N° de Pedido</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="email">Email</x-input-livewire>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-button wire:click="save" wire:loading.remove wire:target="save">
                    Agregar Usuario
                </x-jet-button>
                <x-jet-button wire:loading.flex wire:target="save" class="items-center" disabled>
                    <div class="loading-spin"></div>
                    Cargando
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>