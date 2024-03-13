<x-app-layout>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Criar Perfil</h1>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('perfil.store') }}">
            @csrf

            <div class="form-floating">
                <x-text-input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" :value="old('name')" required />
                <label for="name">Nome</label>
                <x-input-error :messages="$errors->get('name')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating mt-3">
                <x-text-input id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" :value="old('email')" required />
                <label for="email">E-mail</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating mt-3">
                <x-text-input id="local" class="form-control {{ $errors->has('local') ? 'is-invalid' : '' }}" type="text" name="local" :value="old('local')" required />
                <label for="local">Local</label>
                <x-input-error :messages="$errors->get('local')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating mt-3">
                <x-text-input id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" :value="old('phone')" required />
                <label for="phone">Telefone</label>
                <x-input-error :messages="$errors->get('phone')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating mt-3">
                <x-text-input id="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" :value="old('website')" required />
                <label for="website">Website</label>
                <x-input-error :messages="$errors->get('website')" class="mt-2 invalid-feedback" />
            </div>

            <div class="form-floating mt-3">
                <x-text-area id="about" class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" :value="old('about')" required />
                <label for="about">Sobre</label>
                <x-input-error :messages="$errors->get('about')" class="mt-2 invalid-feedback" />
            </div>

            <button class="btn btn-primary w-100 py-2 mt-4" type="submit">Adicionar</button>
        </form>
    </div>
</x-app-layout>
