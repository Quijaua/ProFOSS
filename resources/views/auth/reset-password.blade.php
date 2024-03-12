<main class="form-reset-password w-100 m-auto">
    <x-guest-layout>
        <form method="POST" action="{{ route('password.store') }}">
            <img class="mb-4" src="{{ asset('admin_assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Nova senha</h1>

            @csrf

            <!-- Massages -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

            <button class="btn btn-primary w-100 py-2 mt-4" type="submit">{{ __('Redefinir senha') }}</button>
                
            <p class="mt-2 mb-3 text-body-secondary">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Lembrou?') }}
                </a>
            </p>

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </x-guest-layout>
</main>