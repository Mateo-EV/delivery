<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="Email" />
                @error("email")
                    <x-jet-input id="email" class="block mt-1 w-full error" type="email" name="email" :value="old('email')" required autofocus />
                @else
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                @enderror
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Contraseña" />
                @error("password")
                    <x-jet-input id="password" class="block mt-1 w-full error" type="password" name="password" required autocomplete="current-password" />
                @else
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                @enderror
                <x-jet-input-error for="password" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-jet-button class="ml-4" type="submit">
                    Iniciar Sesión
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
