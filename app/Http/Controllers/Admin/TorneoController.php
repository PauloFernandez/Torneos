<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TorneoRequest;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TorneoController extends Controller
{

    public function index(): View
    {
        $torneos = Torneo::all();
        return view('admin.torneos.index', compact('torneos'));
    }

    public function create(): View
    {
        return view('admin.torneos.create');
    }

    public function store(TorneoRequest $request): RedirectResponse
    {
        Torneo::create($request->all());
        return redirect()->route('torneos.index')->with('success', 'Torneo creado exitosamente.');
    }

    public function show(Torneo $torneo): View
    {
        return view('admin.torneos.show', compact('torneo'));
    }

    public function edit(Torneo $torneo): View
    {
        return view('admin.torneos.edit', compact('torneo'));
    }

    public function update(TorneoRequest $request, Torneo $torneo): RedirectResponse
    {
        $torneo->update($request->all());
        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado exitosamente.');
    }

    public function destroy(Torneo $torneo)
    {
        $torneo->delete();
        return back()->with('success', 'Torneo eliminado exitosamente.');
    }
}
