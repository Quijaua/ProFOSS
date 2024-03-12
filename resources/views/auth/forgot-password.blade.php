<main class="form-forgot-password w-100 m-auto">
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            <img class="mb-4" src="{{ asset('admin_assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h1 class="h3 fw-normal">Esqueceu sua senha?</h1>
            <p class="h6 mb-3 fw-normal">Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos por e-mail um link de redefinição de senha que permitirá que você escolha uma nova.</p>

            @csrf
            
            <!-- Massages -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Email Address -->
            <div class="form-floating">
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                <label for="email">E-mail</label>
            </div>
            
            <button class="btn btn-primary w-100 py-2 mt-4" type="submit">{{ __('Enviar link de redefinição de senha') }}</button>
            
            <p class="mt-2 mb-3 text-body-secondary">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Lembrou?') }}
                </a>
            </p>

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </x-guest-layout>
</main>