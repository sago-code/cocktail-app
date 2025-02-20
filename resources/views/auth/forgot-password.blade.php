<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente déjanos saber tu dirección de correo electrónico y te permitiremos restablecer tu contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (!session('email_verified'))
        <form method="POST" action="{{ route('password.checkEmail') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Verificar Correo') }}
                </x-primary-button>
            </div>
        </form>
    @else
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ session('token') }}">

            <!-- Email Address -->
            <input type="hidden" name="email" value="{{ session('email') }}">

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Nueva Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Restablecer Contraseña') }}
                </x-primary-button>
            </div>
        </form>
    @endif
</x-guest-layout>
