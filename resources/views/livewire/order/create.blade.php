<div>
    <button class="bg-main rounded p-2 text-white font-semibold block cursor-pointer z-10 px-3 mt-2" wire:click="$set('open', true)">Nuevo Pedido</button>
    <div x-data="{ state: @entangle('state').defer }">
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
                                    @foreach ($laboratories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-selectm-livewire>
                            </div>
                        </div>
                        <div class="mb-4 mx-1">
                            <x-jet-label value="Descripción del Laboratorio" for="description"/>
                            <textarea class="jet-input block mt-1 w-full" rows="5" disabled wire:model="description"></textarea>
                            <x-jet-input-error for="description" class="mt-2"/>
                        </div>
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-select-livewire model="document" value="Tipo de Documento">
                                    <option value="">Seleccionar Tipo de Documento</option>
                                    <option value="BOLETA">BOLETA</option>
                                    <option value="FACTURA">FACTURA</option>
                                </x-select-livewire>
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
                                    @if ($locations->count()==0)
                                        <span class="italic text-xs ml-2 my-5">No hay destinos disponibles</span>
                                    @else
                                        <span class="italic text-xs ml-2 mt-5">{{ $newLocation ? "Agregue nuevo destino" : "¿Desea agregar otro destino?" }}</span>
                                        <x-jet-danger-button class="w-full mx-1 mb-0" wire:click="$toggle('newLocation')">
                                            {{ $newLocation ? "Cancelar Nuevo Destino" : "Agregar Destino" }}
                                        </x-jet-danger-button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if ($locations && ($locations->count()==0 || $newLocation))
                        <div class="mb-4 mx-1">
                            <x-input-livewire model="address">Dirección</x-input-livewire>
                        </div>
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-input-livewire model="district">Distrito</x-input-livewire>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-input-livewire model="province">Provincia</x-input-livewire>
                            </div>
                        </div>
                        <div class="mb-4 mx-1">
                            <x-jet-label value="Referencia" for="reference"/>
                            <textarea class="jet-input block mt-1 w-full @error('reference') error @enderror" rows="3" wire:model.defer="reference"></textarea>
                            <x-jet-input-error for="reference" class="mt-2"/>
                        </div>
                        @else
                            @if ($customer)
                            <div class="mb-4 mx-1">
                                <x-selectm-livewire model="location" value="Dirección">
                                    <option value="">Seleccionar el Destino</option>
                                    @foreach ($locations as $item)
                                        <option value="{{ $item->id }}">{{ $item->address }}</option>
                                    @endforeach
                                </x-selectm-livewire>
                            </div>
                            @else
                            <div class="mb-4 mx-1">
                                <x-jet-label value="Destino" />
                                <select class="jet-input w-full block mt-1" disabled>
                                    <option value="">Seleccione Cliente</option>
                                </select>
                            </div>
                            @endif
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-jet-label value="Distrito"/>
                                <x-jet-input type="text" class="w-full block mt-1" wire:model.defer="district" disabled>Distrito</x-jet-input>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-jet-label value="Provincia"/>
                                <x-jet-input type="text" class="w-full block mt-1" wire:model.defer="province" disabled>Provincia</x-jet-input>
                            </div>
                        </div>
                        <div class="mb-4 mx-1">
                            <x-jet-label value="Referencia" for="reference"/>
                            <textarea class="jet-input block mt-1 w-full" rows="3" disabled wire:model.defer="reference"></textarea>
                            <x-jet-input-error for="reference" class="mt-2"/>
                        </div>
                        @endif
                    </div>
                    <div class="w-1/3">
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-select-livewire value="Condición de Pago" model="payment">
                                    <option value="">Seleccionar Condicion de Pago</option>
                                    <option value="CONTADO">CONTADO</option>
                                    <option value="CRÉDITO">CRÉDITO</option>
                                </x-select-livewire>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-select-livewire value="Medio de Cobranza" model="channel">
                                    <option value="">Seleccionar Medio de Cobranza</option>
                                    <option value="DEPÓSITO">DEPÓSITO</option>
                                    <option value="EFECTIVO">EFECTIVO</option>
                                    <option value="MASTERCARD">MASTERCARD</option>
                                    <option value="VISA">VISA</option>
                                </x-select-livewire>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="flex-1 mx-1">
                                <x-select-livewire value="Moneda" model="currency">
                                    <option value="">Seleccionar Moneda</option>
                                    <option value="SOL">SOL</option>
                                    <option value="DÓLAR">DÓLAR</option>
                                </x-select-livewire>
                            </div>
                            <div class="flex-1 mx-1">
                                <x-input-livewire type="number" model="amount">Importe</x-input-livewire>
                            </div>
                        </div>
                        <div class="mx-1 mb-4">
                            <x-input-livewire type="date" model="arrival">Fecha de Llegada</x-input-livewire>
                        </div>
                        <div class="mx-1 mb-4">
                            <x-select-livewire model="motorcyclist" value="Motorizado">
                                <option value="">Seleccionar Motorizado</option>
                                @foreach ($motorcyclists as $motorcyclist)
                                    <option value="{{ $motorcyclist->user_id }}">{{ $motorcyclist->user->name }}</option>
                                @endforeach
                            </x-select-livewire>
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
                    <template x-if="state < 2">
                        <x-jet-button x-on:click="$dispatch('nextstate')">
                            Siguiente
                        </x-jet-button>
                    </template>
                    <x-jet-button wire:click="save" x-bind:class="{ hidden: state<2 }">
                        Agregar Pedido
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
@push('js')
    <script>
        window.addEventListener('nextstate', (e)=>{
            @this.call('nextstate')
        })
    </script>
@endpush