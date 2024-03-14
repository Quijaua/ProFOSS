<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Issues</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('issues.create') }}" class="btn btn-sm btn-outline-secondary">
                    Adicionar
                </a>
            </div>
        </div>
    </div>

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Link</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>
                        <a href="{{ $issue->url }}" target="_blank">
                            {{ $issue->url }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-secondary">
                            Editar
                        </a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger ">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum dado cadastrado.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $issues->links() }}
    </div>
</x-app-layout>
