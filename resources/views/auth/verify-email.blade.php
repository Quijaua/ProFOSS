<main class="form-reset-password w-100 m-auto" style="max-width: 600px !important;">
    <x-guest-layout>
        <div class="mb-3">
            {{ __('Obrigado por inscrever-se! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em lhe enviar outro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="small mb-4">
                {{ __('Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}" class="mb-0">
                @csrf

                <div>
                    <x-primary-button class="btn btn-primary border-0 fw-semibold w-100">
                        {{ __('Reenviar email de verificação') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-decoration-underline border-0 bg-transparent w-100 py-1">
                    {{ __('Sair') }}
                </button>
            </form>
        </div>
    </x-guest-layout>
</main>