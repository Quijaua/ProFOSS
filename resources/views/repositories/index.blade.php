<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Repositórios</h1>
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
            @forelse($repositories as $repository)
                <tr>
                    <td>{{ $repository->name }}</td>
                    <td>
                        <a href="{{ $repository->url }}" target="_blank">
                            {{ $repository->url }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum dado cadastrado.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $repositories->links() }}
    </div>
</x-app-layout>
