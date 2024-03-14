<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Criar Projeto</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <div class="form-floating my-3">
                <x-text-input id="url" class="form-control" type="text" name="url" :value="old('url')" required autofocus />
                <label for="url">URL</label>
                <x-input-error class="mt-2" :messages="$errors->get('url') ?: session('error')" />
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">{{ __('Importar') }}</button>
        </form>
    </div>
</x-app-layout>
