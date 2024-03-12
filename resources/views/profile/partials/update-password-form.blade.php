<section>
    <header>
        <h2 class="fs-4">
            {{ __('Atualizar senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para permanecer segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-success dark:text-success"
            >{{ __('Senha atualizada com sucesso!') }}</p>
        @endif
        
        <!-- Current Password -->
        <div class="form-floating">
            <input id="current_password" class="form-control" type="password" name="current_password" autocomplete="current_password">
            <label for="current_password">Senha atual</label>
            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
        </div>
        
        <!-- Password -->
        <div class="form-floating my-3">
            <input id="password" class="form-control" type="password" name="password" autocomplete="new-password">
            <label for="password">Nova Senha</label>
            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
        </div>
        
        <!-- Password Confirmation -->
        <div class="form-floating my-3">
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password">
            <label for="password_confirmation">Confirme sua senha</label>
            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary border-0 fw-semibold px-4 py-2 small">{{ __('Salvar') }}</x-primary-button>
        </div>
    </form>
</section>
