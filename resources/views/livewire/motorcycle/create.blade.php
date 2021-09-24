<div>
    <button class="bg-main rounded p-2 text-white font-semibold mb-2 block cursor-pointer z-10 px-3" wire:click="$set('open', true)">Agregar Motorizado</button>
    <x-jet-dialog-modal color="bg-main" wire:model="open">
        <x-slot name="title">
            Nuevo Motorizado
        </x-slot>
        <x-slot name="content">
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="name">Nombre</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="email">Email</x-input-livewire>
                </div>
            </div>
            <div class="mb-4 mx-1">
                <x-jet-label value="Contraseña" for="password" />
                <div class="flex">
                    @error('password')
                        <x-jet-input type="text" wire:model.defer="password" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="password" class="block mt-1 w-full"/>
                    @enderror
                        <x-jet-button class="ml-4" title="Generador de Contraseña" wire:click="generate">
                            <i class="fas fa-key"></i>
                        </x-jet-button>
                </div>
                <x-jet-input-error for="password" class="mt-2"/>
            </div>
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="dni">Dni</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="telephone">Teléfono</x-input-livewire>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="license">Licencia</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="model">Modelo</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="km">KM</x-input-livewire>
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
