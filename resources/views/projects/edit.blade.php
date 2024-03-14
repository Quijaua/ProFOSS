<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Projeto</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('projects.update', $project->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-floating my-3">
                <x-text-input id="url" class="form-control" type="text" name="url" :value="old('url', $project->url)" disabled />
                <label for="url">URL</label>
            </div>

            <div class="form-floating">
                <x-text-input id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" :value="old('title', $project->title)" required />
                <label for="title">Título</label>
                <x-input-error :messages="$errors->get('title')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating my-3">
                <x-text-area id="short_description" class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" name="short_description" :value="old('short_description', $project->short_description)" required />
                <label for="short_description">Descrição</label>
                <x-input-error :messages="$errors->get('short_description')" class="mt-2 invalid-feedback" />
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">{{ __('Salvar') }}</button>
        </form>
    </div>
</x-app-layout>
