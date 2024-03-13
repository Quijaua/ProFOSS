<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Perfis</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('perfil.create') }}" class="btn btn-sm btn-outline-secondary">
                    Adicionar
                </a>
            </div>
        </div>
    </div>

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Website</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @forelse($perfis as $perfil)
                    <tr>
                        <td>
                            <a href="{{ route('perfil.show', $perfil->id) }}">
                                {{ $perfil->id }}
                            </a>
                        </td>
                        <td>{{ $perfil->name }}</td>
                        <td>{{ $perfil->email }}</td>
                        <td>
                            <a href="{{ $perfil->website }}" target="_blank">
                                {{ $perfil->website }}
                            </a>
                        </td>
                        <td>
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum perfil cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $perfis->links() }}
    </div>
</x-app-layout>
