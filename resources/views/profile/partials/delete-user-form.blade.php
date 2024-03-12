<style>
    .btn-outline-light:hover {
        background: rgb(180, 180, 180, .1) !important;
    }
</style>

<section class="space-y-6">
    <header>
        <h2 class="fs-4">
            {{ __('Deletar conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, baixe todos os dados ou informações que deseja reter.') }}
        </p>
    </header>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger border-0 fw-semibold px-4 py-2 small" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ __('Deletar conta') }}</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                <div class="modal-body">

                        @csrf
                        @method('delete')

                        <h2 class="fs-5">
                            {{ __('Tem certeza de que deseja excluir sua conta?') }}
                        </h2>

                        <p class="mt-1">
                            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Digite sua senha para confirmar que deseja excluir permanentemente sua conta.') }}
                        </p>

                        <div class="mt-6">
                            <!-- Password -->
                            <div class="form-floating">
                                <input id="password" class="form-control" type="password" name="password" autocomplete="new-password">
                                <label for="password">Senha</label>
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                            </div>

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light border-secondary-subtle text-secondary-emphasis fw-semibold px-4 py-2 small" data-bs-dismiss="modal">Cancelar</button>

                    <x-danger-button class="btn btn-danger border-danger fw-semibold px-4 py-2 small">
                        {{ __('Deletar conta') }}
                    </x-danger-button>
                </div>
                    </form>
            </div>
        </div>
    </div>
</section>
<script>
    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `New message to ${recipient}`
            modalBodyInput.value = recipient
        })
    }
</script>