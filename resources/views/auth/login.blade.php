<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="d-flex flex-column">
            <x-input-label class="form-label fs-5" for="email" :value="__('Correo')" />
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="d-flex flex-column mt-4">
            <x-input-label class="form-label fs-5" for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="d-inline-flex align-items-center">
                <input id="remember_me" type="checkbox" class="rounded" name="remember">
                <span class="ms-2 fs-6">{{ __('Recordar Inicio') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a id="forgot-link" href="{{ route('password.request') }}">¿Olvidé mi Contraseña?</a>
            <button class="btn-primary pe-5 ps-5 p-2 fs-5 fw-bolder rounded ms-4" type="submit">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
