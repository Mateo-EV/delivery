@auth
<x-app-layout>
    <div class="mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-welcome />
        </div>
    </div>
</x-app-layout>
@else
    @include('auth.login')
@endauth