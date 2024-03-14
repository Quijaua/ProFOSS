<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Visualizar Projeto</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <div class="form-floating my-3">
            <x-text-input id="url" class="form-control" type="text" name="url" :value="$project->url" disabled />
            <label for="url">URL</label>
        </div>

        <div class="form-floating">
            <x-text-input id="title" class="form-control" type="text" name="title" :value="$project->title" disabled />
            <label for="title">Título</label>
        </div>

        <div class="form-floating my-3">
            <x-text-area id="body" class="form-control" name="body" :value="$project->short_description" disabled />
            <label for="body">Descrição</label>
        </div>

        <div class="mt-3 d-flex justify-content-end gap-2">
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-secondary">
                Editar
            </a>
            <form action="{{ route('projects.destroy', $project->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    Excluir
                </button>
            </form>
        </div>

        <hr>

        <div class="my-3">
            <h4>Issues vinculadas</h4>
            <ul>
                @if($issue = $project->issue)
                    <li>
                        <a href="{{ route('issues.show', $issue->id) }}">
                            {{ $issue->title }}
                        </a>
                    </li>
                @else
                    <p>Nenhuma issue vinculada</p>
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>
