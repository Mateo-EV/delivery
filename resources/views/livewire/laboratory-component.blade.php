<div>
    <x-container-table>
        <div class="flex flex-col justify-between sm:flex-row">
            @livewire('laboratory.create')
            <div class="my-2 sm:my-0">
                <span>Buscar:</span><x-jet-input type="search" class="w-full sm:ml-2 sm:w-auto" wire:model="search"/>
            </div>
        </div>
        <x-table>
            <x-slot name="header">
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('name')">
                    Nombre
                    @if ($sort == 'name')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer lg:w-1/2" wire:click="order('description')">
                    Descripción
                    @if ($sort == 'description')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th colspan="2"></th>
            </x-slot>
            <x-slot name="body">
                @foreach ($laboratories as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap sm:whitespace-normal">{{ $item->description }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-green-500 text-white py-2 px-3 rounded-md" wire:click="edit('{{ $item->id }}')">
                            <i class="fas fa-user-edit"></i>
                        </button>
                    </td>
                    <td class="px-4 py-2">
                        <button class="bg-red-500 text-white py-2 px-3 rounded-md" x-on:click="$dispatch('destroy', '{{ $item->id }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @if (!$laboratories->count() > 0)
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No hay ningún registro</td>
                    </tr>
                @endif
            </x-slot>
        </x-table>
        @if ($laboratories->hasPages())
        <x-footer-table>
            {{ $laboratories->links() }}
        </x-footer-table>
        @endif
    </x-container-table>
    <x-jet-dialog-modal wire:model="open" color="bg-green-500">
        <x-slot name="title">
            Editar Laboratorio
        </x-slot>
        <x-slot name="content">
            <div class="mb-4 mx-1">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="laboratory.name">Nombre</x-input-livewire>
                </div>
            </div>
            <div class="mb-4 mx-1">
                <div class="flex-1 mx-1">
                    <x-jet-label value="Descripción" for="description"/>
                    @error("description")
                        <textarea wire:model.defer="laboratory.description" class="jet-input block mt-1 w-full error"></textarea>
                    @else
                        <textarea wire:model.defer="laboratory.description" class="jet-input block mt-1 w-full" rows="5"></textarea>
                    @enderror
                    <x-jet-input-error for="laboratory.description" class="mt-2"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-button wire:click="update" wire:loading.remove wire:target="update" color="bg-green-500">
                    Editar Laboratorio
                </x-jet-button>
                <x-jet-button wire:loading.flex wire:target="update" class="items-center" disabled>
                    <div class="loading-spin"></div>
                    Cargando
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
@push('js')
    <script>
        window.addEventListener('destroy', (id)=>{
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'El laboratorio será eliminado',
                icon: "info",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#F00'
            }).then(e=>{
                if(e.value){
                    @this.call('destroy', id.detail)
                }
            })
        })
    </script>
@endpush
