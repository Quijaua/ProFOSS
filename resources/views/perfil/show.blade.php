<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Visualizar Perfil</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div class="form-floating">
            <x-text-input id="name" class="form-control" type="text" name="name" :value="$perfil->name" disabled />
            <label for="name">Nome</label>
        </div>

        <div class="form-floating mt-3">
            <x-text-input id="email" class="form-control" type="email" name="email" :value="$perfil->email" disabled />
            <label for="email">E-mail</label>
        </div>

        <div class="form-floating mt-3">
            <x-text-input id="local" class="form-control" type="text" name="local" :value="$perfil->local" disabled />
            <label for="local">Local</label>
        </div>

        <div class="form-floating mt-3">
            <x-text-input id="phone" class="form-control" type="text" name="phone" :value="$perfil->phone" disabled />
            <label for="phone">Telefone</label>
        </div>

        <div class="form-floating mt-3">
            <x-text-input id="website" class="form-control" type="text" name="website" :value="$perfil->website" disabled />
            <label for="website">Website</label>
        </div>

        <div class="form-floating mt-3">
            <x-text-area id="about" class="form-control" name="about" :value="$perfil->about" rows="5" disabled />
            <label for="about">Sobre</label>
        </div>


        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('perfil.edit', $perfil->id) }}" class="btn btn-sm btn-outline-secondary">
                Editar
            </a>
            <form action="{{ route('perfil.destroy', $perfil->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    Excluir
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
