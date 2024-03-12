<main class="form-signup w-100 m-auto">
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}">
            <img class="mb-4" src="{{ asset('admin_assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Por favor se registre</h1>

            @csrf

            <!-- Messages -->
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <!-- Name -->
            <div class="form-floating">
                <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                <label for="name">Nome</label>
            </div>

            <!-- Email Address -->
            <div class="form-floating">
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username">
                <label for="email">E-mail</label>
            </div>

            <!-- Password -->
            <div class="form-floating">
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                <label for="password">Senha</label>
            </div>

            <!-- Confirm Password -->
            <div class="form-floating">
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                <label for="password_confirmation">Confirmar Senha</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">{{ __('Registrar') }}</button>

            <p class="mt-2 mb-3 text-body-secondary">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Já registrado?') }}
                </a>
            </p>

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </x-guest-layout>
</main>