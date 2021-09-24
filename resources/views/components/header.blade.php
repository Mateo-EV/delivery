<div class="sticky w-full z-20 top-0 flex flex-row flex-wrap items-center bg-main px-6 py-3 md:py-5 border-b border-gray-300 justify-between">

    <!-- logo -->
    <div class="flex">
        <div x-on:click="open=!open" class="mr-6 text-gray-200 flex items-center cursor-pointer">
            <i class="fas fa-bars text-lg"></i>
        </div>
        <div class="flex-none items-center hidden md:flex">
            <img src="{{ asset('img/cropped-cropped-gestionesmovileslogo-1-1.png') }}" class="w-32 flex-none">
        </div>
    </div>
    <!-- end logo -->

    <!-- navbar content -->
    <div class="flex pl-3 flex-row flex-wrap justify-between items-center md:flex-col">
        <!-- right -->
        <div class="flex flex-row-reverse items-center">

            <!-- user -->
            <div class="mr-5 md:relative" x-data="{ dropdown : false }">

                <button class="focus:outline-none focus:shadow-outline flex flex-wrap items-center" x-on:click="dropdown=!dropdown">
                    <div class="w-8 h-8 overflow-hidden rounded-full">
                        <img class="w-full h-full object-cover" src="{{ auth()->user()->profile_photo_url }}">
                    </div>

                    <div class="ml-2 capitalize flex text-gray-200">
                        <h1 class="text-sm font-semibold m-0 p-0 leading-none">{{ explode(' ', auth()->user()->name)[0] }}</h1>
                        <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
                    </div>
                </button>

                <div class="rounded-md text-gray-500 w-full md:w-40 bg-white shadow-md absolute z-20 right-0 mt-5 overflow-hidden md:rounded" x-show="dropdown" x-transition.origin.top.right x-on:click.away="dropdown=false" style="display: none">

                    <p class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200"><span class="underline uppercase">Perfil</span>: {{ Auth::user()->roles[0]->name }}</p>

                    <hr>

                    <!-- item -->
                    <x-jet-responsive-nav-link :active="request()->routeIs('profile.show')" href="{{ route('profile.show') }}">
                        <i class="fad fa-user-edit text-xs mr-1"></i>
                        Editar Perfil
                    </x-jet-responsive-nav-link>

                    <!-- item -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="px-4 py-2 capitalize font-medium text-sm tracking-wide hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out">
                            <i class="fad fa-user-times text-xs mr-1"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                    <!-- end item -->

                </div>
            </div>
            <!-- end user -->

            <!-- notifcation -->
            <div class="mr-5 md:relative" x-data="{ dropdown : false }">

                <button class="text-gray-200 menu-btn p-0 m-0 hover:text-gray-300 focus:text-gray-300 focus:outline-none transition-all ease-in-out duration-300" x-on:click="dropdown=!dropdown">
                    <i class="fad fa-bells"></i>
                </button>

                <div class="rounded-md bg-white w-full shadow-md absolute z-20 right-0 py-2 mt-5 md:w-80 md:rounded" x-show="dropdown" x-transition.origin.top.right x-on:click.away="dropdown=false" style="display: none">
                    <!-- top -->
                    <div class="px-4 py-2 flex flex-row justify-between items-center capitalize font-semibold text-sm">
                        <h1>notifications</h1>
                        <div class="bg-teal-100 border border-teal-200 text-teal-500 text-xs rounded px-1">
                            <strong>5</strong>
                        </div>
                    </div>
                    <hr>
                    <!-- end top -->

                    <!-- body -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <i class="fad fa-birthday-cake text-sm"></i>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">poll..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>4 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <i class="fad fa-user-circle text-sm"></i>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mohamed..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>78 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <i class="fad fa-images text-sm"></i>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">new imag..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>65 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <i class="fad fa-alarm-exclamation text-sm"></i>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">time is up..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>1 min ago</p>
                            </div>
                        </div>

                    </a>
                    <!-- end item -->


                    <!-- end body -->

                    <!-- bottom -->
                    <hr>
                    <div class="px-4 py-2 mt-2">
                        <a href="#"
                            class="border border-gray-300 block text-center text-xs uppercase rounded p-1 hover:text-teal-500 transition-all ease-in-out duration-500">
                            view all
                        </a>
                    </div>
                    <!-- end bottom -->
                </div>
            </div>
            <!-- end notifcation -->

            {{-- <!-- messages -->
            <div class="dropdown relative mr-5 md:static" x-data="{ dropdown : false }">

                <button class="text-gray-500 menu-btn p-0 m-0 hover:text-gray-900 focus:text-gray-900 focus:outline-none transition-all ease-in-out duration-300" x-on:click="dropdown=!dropdown">
                    <i class="fad fa-comments"></i>
                </button>

                <div class="md:w-full md:right-0 rounded bg-white shadow-md absolute z-20 right-0 w-84 mt-5 py-2" x-show="dropdown" x-transition.origin.top.right x-on:click.away="dropdown=false">
                    <!-- top -->
                    <div class="px-4 py-2 flex flex-row justify-between items-center capitalize font-semibold text-sm">
                        <h1>messages</h1>
                        <div class="bg-teal-100 border border-teal-200 text-teal-500 text-xs rounded px-1">
                            <strong>3</strong>
                        </div>
                    </div>
                    <hr>
                    <!-- end top -->

                    <!-- body -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user1.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mohamed said</h1>
                                <p class="text-xs text-gray-500">yeah i know</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>4 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user2.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">sull goldmen</h1>
                                <p class="text-xs text-gray-500">for sure</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>1 day ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start px-4 py-4 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out"
                        href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user3.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mick</h1>
                                <p class="text-xs text-gray-500">is typing ....</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                                <p>31 feb</p>
                            </div>
                        </div>

                    </a>
                    <!-- end item -->


                    <!-- end body -->

                    <!-- bottom -->
                    <hr>
                    <div class="px-4 py-2 mt-2">
                        <a href="#"
                            class="border border-gray-300 block text-center text-xs uppercase rounded p-1 hover:text-teal-500 transition-all ease-in-out duration-500">
                            view all
                        </a>
                    </div>
                    <!-- end bottom -->
                </div>
            </div>
            <!-- end messages --> --}}
        </div>
        <!-- end right -->
    </div>
    <!-- end navbar content -->
</div>
<!-- end navbar -->