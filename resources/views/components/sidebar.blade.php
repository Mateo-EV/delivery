<!-- start sidebar -->
<div :class="{ '-left-64' : !open, 'left-0' : open, 'lg:left-0' : open }" class="flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 shadow-xl transition-all -left-64 fixed justify-between h-sidebar duration-500 z-50 lg:left-0">

    <!-- sidebar content -->
    <div class="flex flex-col overflow-y-auto">

        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Administración</p>

        <!-- link -->
        <x-jet-nav-link href="{{ route('laboratories') }}" :active="request()->routeIs('laboratories')">
            <i class="fad fa-flask w-4 mx-2"></i>
            Laboratorios
        </x-jet-nav-link>
        <!-- end link -->

        <!-- link -->
        <x-jet-nav-link href="{{ route('motorcycles') }}" :active="request()->routeIs('motorcycles')">
            <i class="fad fa-motorcycle text-xs w-4 mx-2"></i>
            Motorizados
        </x-jet-nav-link>
        <!-- end link -->

        <!-- link -->
        <x-jet-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
            <i class="fad fa-user text-xs w-4 mx-2"></i>
            Usuarios
        </x-jet-nav-link>
        <!-- end link -->

        <p class="uppercase text-xs text-gray-600 my-4 tracking-wider">Recepción</p>
        
        <!-- link -->
        <x-jet-nav-link href="{{ route('orders') }}" :active="request()->routeIs('orders')">
            <i class="fad fa-box-open w-4 mx-2"></i>
            Pedidos
        </x-jet-nav-link>
        <!-- end link -->

        <!-- link -->
        <x-jet-nav-link>
            <i class="fad fa-user-hard-hat w-4 mx-2"></i>
            Clientes
        </x-jet-nav-link>
        <!-- end link -->

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Cuentas</p>

        <!-- link -->
        <x-jet-nav-link>
            <i class="fad fa-file-alt text-xs w-4 mx-2"></i>
            Reporte de Pedidos
        </x-jet-nav-link>
        <!-- end link -->

        <!-- link -->
        <x-jet-nav-link>
            <i class="fad fa-comment-alt-exclamation text-xs w-4 mx-2"></i>
            Reclamos
        </x-jet-nav-link>
        <!-- end link -->

        <!-- link -->
        <x-jet-nav-link>
            <i class="fad fa-sack-dollar text-xs w-4 mx-2"></i>
            Cuentas por cobrar
        </x-jet-nav-link>
        <!-- end link -->

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Seguimiento</p>
    
        <!-- link -->
        <x-jet-nav-link>
            <i class="fad fa-truck-loading text-xs w-4 mx-2"></i>
            Seguimiento de Pedidos
        </x-jet-nav-link>
        <!-- end link -->
    </div>
    <!-- end sidebar content -->

</div>
<!-- end sidbar -->
