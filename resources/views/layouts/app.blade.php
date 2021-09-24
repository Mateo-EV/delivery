<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @stack('css')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/prism.css') }}">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased" x-data="{ open: window.innerWidth >= 1024 }">
        {{-- <x-jet-banner /> --}}
        <x-header />

        <div class="flex flex-row flex-wrap">
            {{-- @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                
            </main> --}}
            <x-sidebar />

            <div class="bg-gray-100 flex-1 p-6 transition-all h-main duration-500 overflow-hidden ml-0 lg:ml-64" :class="{ 'ml-64' : window.innerWidth >= 1024 && open, 'ml-0' : !open, 'lg:ml-64' : open}">
                {{ $slot }}
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('js')

        <script>
            Livewire.on('success', (message)=>{
                Swal.fire(
                    'Buen trabajo',
                    message,
                    'success'
                )
            })
        </script>
    </body>
</html>
