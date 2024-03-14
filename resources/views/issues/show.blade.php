<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Visualizar Issue</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div class="form-floating my-3">
            <x-text-input id="url" class="form-control" type="text" name="url" :value="$issue->url" disabled />
            <label for="url">URL</label>
        </div>

        <div class="form-floating">
            <x-text-input id="title" class="form-control" type="text" name="title" :value="$issue->title" disabled />
            <label for="title">Título</label>
        </div>

        <div class="form-floating my-3">
            <x-text-area id="body" class="form-control" name="body" :value="$issue->body" disabled />
            <label for="body">Descrição</label>
        </div>

        <div class="mt-3 d-flex justify-content-end gap-2">
            <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-secondary">
                Editar
            </a>
            <form action="{{ route('issues.destroy', $issue->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    Excluir
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
