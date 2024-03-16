<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function index(): View
    {
        $repositories = Repository::query()->paginate(25);

        return view('repositories.index', compact('repositories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Repository $repository)
    {
        //
    }

    public function edit(Repository $repository)
    {
        //
    }

    public function update(Request $request, Repository $repository)
    {
        //
    }

    public function destroy(Repository $repository)
    {
        //
    }
}
