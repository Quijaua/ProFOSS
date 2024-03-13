<?php

namespace App\Http\Controllers;

use App\Http\Requests\Perfil\Create as PerfilCreate;
use App\Http\Requests\Perfil\Update as PerfilUpdate;
use App\Models\Perfil;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class PerfilController extends Controller
{
    public function index(): View
    {
        $perfis = Perfil::query()->paginate(25);

        return view('perfil.index', compact('perfis'));
    }

    public function create(): View
    {
        return view('perfil.create');
    }

    public function store(PerfilCreate $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $perfil = Perfil::query()->create($validated);
        } catch (Throwable $e) {
            Log::error("Erro ao adicionar perfil: {$e->getMessage()}");

            return back()
                ->with('status', 'error')
                ->with('message', 'Erro ao adicionar perfil.');
        }

        return redirect()->route('perfil.show', $perfil->id);
    }

    public function show(Perfil $perfil): View
    {
        return view('perfil.show', compact('perfil'));
    }

    public function edit(Perfil $perfil): View
    {
        return view('perfil.edit', compact('perfil'));
    }

    public function update(PerfilUpdate $request, Perfil $perfil): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $perfil->update($validated);
        } catch (Throwable $e) {
            Log::error("Erro ao editar perfil (ID: $perfil->id): {$e->getMessage()}");

            return back()
                ->with('status', 'error')
                ->with('message', 'Erro ao editar perfil.');
        }

        return redirect()->route('perfil.show', $perfil->id);
    }

    public function destroy(Perfil $perfil): RedirectResponse
    {
        try {
            $perfil->delete();
        } catch (Throwable $e) {
            Log::error("Erro ao excluir o perfil: {$e->getMessage()}");

            return back()
                ->with('status', 'error')
                ->with('message', 'Erro ao excluir o perfil.');
        }

        return redirect()->route('perfil.index');
    }
}
