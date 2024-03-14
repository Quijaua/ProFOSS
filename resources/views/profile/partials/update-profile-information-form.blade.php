<section>
    <header>
        <h2 class="fs-4">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações de perfil e endereço de e-mail da sua conta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div class="form-floating">
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
            <label for="name">Nome</label>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="my-3">
            <div class="form-floating">
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                <label for="email">E-mail</label>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-floating my-3">
            <x-text-input id="local" class="form-control" type="text" name="local" :value="old('local', $user->local)" />
            <label for="local">Local</label>
            <x-input-error class="mt-2" :messages="$errors->get('local')" />
        </div>

        <div class="form-floating my-3">
            <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone', $user->phone)" />
            <label for="phone">Telefone</label>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="form-floating my-3">
            <x-text-input id="website" class="form-control" type="text" name="website" :value="old('website', $user->website)" />
            <label for="website">Website</label>
            <x-input-error class="mt-2" :messages="$errors->get('website')" />
        </div>

        <div class="form-floating my-3">
            <x-text-area id="about" class="form-control" name="about" :value="old('about', $user->about)" rows="5" />
            <label for="about">Sobre</label>
            <x-input-error class="mt-2" :messages="$errors->get('about')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary border-0 fw-semibold px-4 py-2 small">{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
