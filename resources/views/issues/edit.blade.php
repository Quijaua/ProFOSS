<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Issue</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('issues.update', $issue->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-floating my-3">
                <x-text-input id="url" class="form-control" type="text" name="url" :value="old('url', $issue->url)" disabled />
                <label for="url">URL</label>
            </div>

            <div class="form-floating">
                <x-text-input id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" :value="old('title', $issue->title)" required />
                <label for="title">Título</label>
                <x-input-error :messages="$errors->get('title')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating my-3">
                <x-text-area id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" :value="old('body', $issue->body)" required />
                <label for="body">Descrição</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2 invalid-feedback" />
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">{{ __('Salvar') }}</button>
        </form>
    </div>
</x-app-layout>
