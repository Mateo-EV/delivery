<div>
    <button class="bg-main rounded p-2 text-white font-semibold block cursor-pointer z-10 px-3 mt-2" wire:click="$set('open', true)">Nuevo Pedido</button>
    <div x-data="{ state: 0 }">
        <x-jet-dialog-modal wire:model="open" color="bg-main">
            <x-slot name="title">
                Nuevo Pedido
            </x-slot>
            <x-slot name="content">
                <div :style="{ width: '300%', marginLeft: state*-100+'%' }"
                    class="transition-all duration-700 flex">
                    <div class="w-1/3">
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-input-livewire model="code">N° de Pedido</x-input-livewire>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-selectm-livewire model="laboratory" value="Laboratorio">
                                    <option value="">Seleccionar Laboratorio</option>
                                    @foreach ($laboratories as $laboratory)
                                        <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                                    @endforeach
                                </x-selectm-livewire>
                            </div>
                        </div>
                        @if ($description)
                        <div class="mb-4">
                            <x-jet-label value="Descripción del Laboratorio" for="description"/>
                            <textarea class="jet-input block mt-1 w-full" rows="3" disabled>{{ $description }}</textarea>
                            <x-jet-input-error for="description" class="mt-2"/>
                        </div>
                        @endif
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-input-livewire model="document">Tipo de Documento</x-input-livewire>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-input-livewire model="ndocument">Número de Documento</x-input-livewire>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3">
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-jet-label value="Cliente" for="customer" />
                                @error($customer)
                                    <select class="jet-input block mt-1 w-full error" wire:model="customer">
                                        <option value="">Seleccionar Cliente</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="jet-input block mt-1 w-full" wire:model="customer">
                                        <option value="">Seleccionar Cliente</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                @enderror
                                <x-jet-input-error for="customer" class="mt-2"/>
                            </div>
                            <div class="flex-1 mx-1">
                                @if ($customer)
                                    @if($locations->count()>0)
                                    <x-select-livewire model="location" value="Destino">
                                        <option value="">
                                            Seleccionar el Destino
                                        </option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->address }}</option>
                                        @endforeach
                                    </x-select-livewire>
                                    @else
                                    <span class="italic text-xs ml-2 mt-5">No hay destinos disponibles</span>
                                    <x-jet-danger-button class="w-full mx-1 mb-0">Nuevo Destino</x-jet-danger-button>
                                    @endif
                                @else
                                    <x-select-livewire model="location" value="Destino" disabled>
                                        <option value="">Seleccione al Cliente</option>
                                    </x-select-livewire>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 mx-1">
                            <x-input-livewire model="address" disabled>Dirección</x-input-livewire>
                        </div>
                    </div>
                </div>
                <div class="bg-main h-1 rounded transition-all duration-500" :style="{ width: (state+1)*33.333333+'%' } "></div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex items-center justify-between">
                    <x-jet-secondary-button wire:click="$set('open', false)" x-bind:class="{ hidden: state>0 }">
                        Cancelar
                    </x-jet-secondary-button>
                    <template x-if="state > 0">
                        <x-jet-secondary-button x-on:click="state--">
                            Anterior
                        </x-jet-secondary-button>
                    </template>
                    <x-jet-button x-on:click="state++">
                        Siguiente
                    </x-jet-button>
                    {{-- <x-jet-button wire:loading.flex wire:target="save" class="items-center" disabled>
                        <div class="loading-spin"></div>
                        Cargando
                    </x-jet-button> --}}
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
{{-- @push('js')
    <script>
        window.addEventListener('close', ()=>{
            @this.set('open', false)
        })
    </script>
@endpush --}}