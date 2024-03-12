<main class="form-signin w-100 m-auto">
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            <img class="mb-4" src="{{ asset('admin_assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Por favor entre</h1>

            @csrf
            
            <!-- Messages -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Email Address -->
            <div class="form-floating">
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <label for="email">E-mail</label>
            </div>

            <!-- Password -->
            <div class="form-floating">
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                <label for="password">Senha</label>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
            <p class="mb-3 text-body-secondary">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            </p>
            @endif

            <!-- Remember Me -->
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">
                    {{ __('Lembre de mim') }}
                </label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">{{ __('Entrar') }}</button>

            <p class="mt-2 mb-3 text-body-secondary">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                    {{ __('Crie a sua conta aqui') }}
                </a>
            </p>

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </x-guest-layout>
</main>