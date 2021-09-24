<div>
    <x-container-table>
        <div class="flex flex-col justify-between sm:flex-row">
            @livewire('motorcycle.create')
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
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('license')">
                    Licencia
                    @if ($sort == 'license')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('model')">
                    Modelo
                    @if ($sort == 'model')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('km')">
                    KM
                    @if ($sort == 'km')
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
                @foreach ($motorcycles as $motorcycle)
                <tr>
                    <td class="py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="{{ $motorcycle->user->profile_photo_url }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $motorcycle->user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $motorcycle->user->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $motorcycle->license }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $motorcycle->model }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $motorcycle->km }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-green-500 text-white py-2 px-3 rounded-md" wire:click="edit({{$motorcycle->id}})">
                            <i class="fas fa-user-edit"></i>
                        </button>
                    </td>
                    <td class="px-4 py-2">
                        <button class="bg-red-500 text-white py-2 px-3 rounded-md" x-on:click="$dispatch('destroy', {{ $motorcycle->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @if (!$motorcycles->count() > 0)
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No hay ningún registro</td>
                    </tr>
                @endif
            </x-slot>
        </x-table>
        @if ($motorcycles->hasPages())
        <x-footer-table>
            {{ $motorcycles->links() }}
        </x-footer-table>
        @endif
    </x-container-table>
    <x-jet-dialog-modal wire:model="open" color="bg-green-500">
        <x-slot name="title">
            Editar Motorizado
        </x-slot>
        <x-slot name="content">
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="user.name">Nombre</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="user.email">Email</x-input-livewire>
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
                        <x-jet-button class="ml-4" title="Generador de Contraseña" wire:click="generate" color="bg-green-500">
                            <i class="fas fa-key"></i>
                        </x-jet-button>
                </div>
                <x-jet-input-error for="password" class="mt-2"/>
            </div>
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-input-livewire model="user.dni">Dni</x-input-livewire>
                </div>
                <div class="flex-1 mx-1">
                    <x-input-livewire model="user.telephone">Teléfono</x-input-livewire>
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
                <x-jet-button wire:click="update" wire:loading.remove wire:target="update" color="bg-green-500">
                    Editar Usuario
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
                text: 'El motorizado será eliminado',
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
