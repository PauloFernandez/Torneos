<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipoRequest;
use App\Http\Services\GestionImagService;
use App\Models\Equipo;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipoController extends Controller
{
    public function __construct(protected GestionImagService $gestionImag){}

    public function index(): View
    {
        $equipos = Equipo::with('torneo')->get();
        return view('admin.equipos.index', compact('equipos'));
    }

    public function create(): View
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('admin.equipos.create', compact('torneos'));
    }

    public function store(EquipoRequest $request): RedirectResponse
    {
        $equipo = Equipo::create($request->all());
        $this->gestionImag->storage($request, $equipo);

        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }

    public function edit(Equipo $equipo)
    {       
        $torneos = Torneo::orderBy('nombre')->get();
        return view('admin.equipos.edit', compact('equipo', 'torneos'));
    }

    public function update(EquipoRequest $request, Equipo $equipo): RedirectResponse
    {
        $equipo->update($request->all());
        $this->gestionImag->storage($request, $equipo);

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $this->gestionImag->delete($equipo);
        $equipo->delete();
        return back()->with('danger', 'Usuario eliminado exitosamente');
    }
}
