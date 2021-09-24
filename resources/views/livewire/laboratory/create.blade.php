<div>
    <button class="bg-main rounded p-2 text-white font-semibold mb-2 block cursor-pointer z-10 px-3" wire:click="$set('open', true)">Agregar Laboratorio</button>
    <x-jet-dialog-modal wire:model="open" color="bg-main">
        <x-slot name="title">
            Nuevo Laboratorio
        </x-slot>
        <x-slot name="content">
            <div class="mb-4 mx-1">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="name">Nombre</x-input-livewire>
                </div>
            </div>
            <div class="mb-4 mx-1">
                <div class="flex-1 mx-1">
                    <x-jet-label value="Descripción" for="description"/>
                    @error("description")
                        <textarea wire:model.defer="description" class="jet-input block mt-1 w-full error"></textarea>
                    @else
                        <textarea wire:model.defer="description" class="jet-input block mt-1 w-full" rows="5"></textarea>
                    @enderror
                    <x-jet-input-error for="description" class="mt-2"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-button wire:click="save" wire:loading.remove wire:target="save">
                    Agregar Laboratorio
                </x-jet-button>
                <x-jet-button wire:loading.flex wire:target="save" class="items-center" disabled>
                    <div class="loading-spin"></div>
                    Cargando
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>