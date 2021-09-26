<div>
    <x-container-table>
        <div class="flex flex-col md:flex-row md:items-end mb-4">
            <div class="my-2 md:my-0 md:mr-3">
                <span class="block mb-2">Buscar:</span><x-jet-input type="search" class="w-full md:w-72" wire:model="search" />
            </div>
            <div class="my-2 md:my-0 md:mr-3">
                <span class="block mb-2">Vista entre fechas</span>
                <x-jet-input type="date" class="w-full md:w-auto mb-3 md:mb-0" wire:model="startdate" max="{{ $enddate }}" />
                <x-jet-input type="date" class="w-full md:w-auto" wire:model="enddate"  min="{{ $startdate }}" />
            </div>
            @livewire('order.create')
        </div>
        <x-table>
            <x-slot name="header">
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('code')">
                    N° Pedido
                    @if ($sort == 'code')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('laboratories.name')">
                    Laboratorio
                    @if ($sort == 'laboratories.name')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('document')">
                    T. Doc
                    @if ($sort == 'document')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('ndocument')">
                    N. Doc
                    @if ($sort == 'ndocument')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('channel')">
                    M. Pago
                    @if ($sort == 'channel')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('amount')">
                    Importe
                    @if ($sort == 'amount')
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                </th>
                <th class="px-6 py-3 text-left cursor-pointer whitespace-nowrap" wire:click="order('users.name')">
                    Motorizado
                    @if ($sort == 'users.name')
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
                @foreach ($orders as $order)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap pr-16">{{ $order->code }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap pr-16">{{ $order->laboratory->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap pr-16">{{ $order->document }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap pr-16">{{ $order->ndocument }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="font-medium text-gray-900">
                            {{ $order->channel }}
                        </div>
                        <div class="text-gray-500 italic">
                            ({{ $order->payment}})
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap pr-16">{{ $order->symbol." ".$order->amount }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $order->motorcyclist->user->name }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-green-500 text-white py-2 px-3 rounded-md">
                            <i class="fas fa-user-edit"></i>
                        </button>
                    </td>
                    <td class="px-4 py-2">
                        <button class="bg-red-500 text-white py-2 px-3 rounded-md">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @if (!$orders->count() > 0)
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No hay ningún registro</td>
                    </tr>
                @endif
            </x-slot>
        </x-table>
        @if ($orders->hasPages())
        <x-footer-table>
            {{ $orders->links() }}
        </x-footer-table>
        @endif
    </x-container-table>
</div>
