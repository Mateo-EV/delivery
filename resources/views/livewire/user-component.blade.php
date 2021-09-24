<div>
    <x-container-table>
        <div class="flex flex-col justify-between sm:flex-row">
            <button class="bg-main rounded p-2 text-white font-semibold mb-2 block cursor-pointer z-10 px-3" wire:click="$set('open', true)">Agregar Usuario</button>
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
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('dni')">
                    Dni
                    @if ($sort == 'dni')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer" wire:click="order('telephone')">
                    Teléfono
                    @if ($sort == 'telephone')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer">Perfil</th>
                <th colspan="2"></th>
            </x-slot>
            <x-slot name="body">
                @foreach ($users as $user)
                <tr>
                    <td class="py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->dni }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->telephone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->roles[0]->name }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-green-500 text-white py-2 px-3 rounded-md" wire:click="edit({{$user->id}})">
                            <i class="fas fa-user-edit"></i>
                        </button>
                    </td>
                    <td class="px-4 py-2">
                        <button class="bg-red-500 text-white py-2 px-3 rounded-md" x-on:click="$dispatch('destroy', {{ $user->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @if (!$users->count() > 0)
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No hay ningún registro</td>
                    </tr>
                @endif
            </x-slot>
        </x-table>
        @if ($users->hasPages())
        <x-footer-table>
            {{ $users->links() }}
        </x-footer-table>
        @endif
    </x-container-table>
    <x-jet-dialog-modal wire:model="open" color="bg-main">
        <x-slot name="title">
            Nuevo Usuario
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
            <div x-data="{ rol : '' }">
                <div class="mb-4 mx-1">
                    <x-jet-label value="Perfil" for="rol" />
                    @error('rol')
                        <select class="jet-input block mt-1 w-full error" wire:model.defer="rol" x-model="rol">
                            <option value="">Seleccionar Perfil</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <select class="jet-input block mt-1 w-full" wire:model.defer="rol" x-model="rol">
                            <option value="">Seleccionar Perfil</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    @enderror
                    <x-jet-input-error for="rol" class="mt-2"/>
                </div>
                <div class="hidden items-center mb-4" :class="{ 'flex' : rol==3, 'hidden': rol!=3 }">
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
    <x-jet-dialog-modal wire:model="open_edit" color="bg-green-500">
        <x-slot name="title">
            Editar Usuario
        </x-slot>
        <x-slot name="content">
            <div class="flex mb-4">
                <div class="flex-1 mx-1">
                    <x-jet-label value="Nombre" for="name" />
                    @error('name')
                        <x-jet-input type="text" class="block mt-1 w-full error" wire:model.defer="name"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="name" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>
                <div class="flex-1 mx-1">
                    <x-jet-label value="Email" for="email" />
                    @error('email')
                        <x-jet-input type="email" wire:model.defer="email" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="email" wire:model.defer="email" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="email" class="mt-2"/>
                </div>
            </div>
            <div class="mb-4 mx-1">
                <x-jet-label value="Cambiar Contraseña" for="password" />
                <div class="flex">
                @error('email')
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
                    <x-jet-label value="Dni" for="dni" />
                    @error('dni')
                        <x-jet-input type="text" wire:model.defer="dni" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="dni" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="dni" class="mt-2"/>
                </div>
                <div class="flex-1 mx-1">
                    <x-jet-label value="Teléfono" for="telephone" />
                    @error('telephone')
                        <x-jet-input type="text" wire:model.defer="telephone" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="telephone" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="telephone" class="mt-2"/>
                </div>
            </div>
            <div class="mb-4 mx-1">
                <x-jet-label value="Perfil" for="rol" />
                @error('rol')
                    <select class="jet-input block mt-1 w-full error" wire:model="rol">
                        <option value="">Seleccionar Perfil</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select class="jet-input block mt-1 w-full" wire:model="rol">
                        <option value="">Seleccionar Perfil</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                @enderror
                <x-jet-input-error for="rol" class="mt-2" />
            </div>
            @if($isMotorized)
            <div class="flex items-center mb-4">
                <div class="flex-1 mx-1">
                    <x-jet-label value="Licencia" for="license" />
                    @error('license')
                        <x-jet-input type="text" wire:model.defer="license" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="license" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="license" class="mt-2"/>
                </div>
                <div class="flex-1 mx-1">
                    <x-jet-label value="Modelo" for="model" />
                    @error('model')
                        <x-jet-input type="text" wire:model.defer="model" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="text" wire:model.defer="model" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="model" class="mt-2"/>
                </div>
                <div class="flex-1 mx-1">
                    <x-jet-label value="KM" for="km" />
                    @error('km')
                        <x-jet-input type="number" wire:model.defer="km" class="block mt-1 w-full error"/>
                    @else
                        <x-jet-input type="number" wire:model.defer="km" class="block mt-1 w-full"/>
                    @enderror
                    <x-jet-input-error for="km" class="mt-2"/>
                </div>
            </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-jet-secondary-button x-on:click="show=false" wire:click="resetAll">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-button wire:click="update" wire:loading.remove wire:target="update" color="bg-green-500">
                    Editar Usuario
                </x-jet-button>
                <x-jet-button wire:loading.flex wire:target="update" class="items-center" disabled color="bg-green-500">
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
                text: 'El usuario será eliminado',
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