<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartidoRequest;
use App\Http\Requests\Admin\UpdatePartidoResultsRequest;
use App\Models\Arbitro;
use App\Models\Cancha;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartidoController extends Controller
{
    public function index(): View
    {
        $partidos = Partido::where('estado', '!=', 'finalizado')
                ->with(['arbitro', 'cancha', 'torneo', 'equipoLocal', 'equipoVisitante'])
                ->orderBy('fecha')->paginate(5);
        return view('admin.partidos.index', compact('partidos'));
    }

    public function create(): View
    {
        $torneos = Torneo::all(); // Obtener todos los torneos
        $arbitros = Arbitro::all();
        $canchas = Cancha::all();
        $equipos = Equipo::all(); // Obtener TODOS los equipos para que JavaScript los filtre

        return view('admin.partidos.create', compact('torneos', 'arbitros', 'canchas', 'equipos'));
    }

    public function store(PartidoRequest $request): RedirectResponse
    {
        Partido::create($request->all());
        return redirect()->route('partidos.index')->with('success', 'Partido creado exitosamente.');
    }

    public function edit(Partido $partido): View
    {
        $torneos = Torneo::all();
        $arbitros = Arbitro::all();
        $canchas = Cancha::all();
        $equipos = Equipo::all(); // Obtener TODOS los equipos para que JavaScript los filtre

        return view('admin.partidos.edit', compact('partido', 'torneos', 'arbitros', 'canchas', 'equipos'));
    }

    public function update(PartidoRequest $request, Partido $partido): RedirectResponse
    {
        $partido->update($request->all());
        return redirect()->route('partidos.index')->with('success', 'Partido actualizado exitosamente.');
    }

    public function destroy(Partido $partido)
    { 
        $partido->delete();
        return back()->with('success', 'Partido eliminado exitosamente.');
    }

    //Nuevos metodos
    //Obtener detalle de un partido para el modal
    public function getDetails(Partido $partido): \Illuminate\Http\JsonResponse
    {
        //Carga la realcion nesesaria para mostrar en el modal
        $partido->load(['equipoLocal', 'equipoVisitante']);

        return response()->json([
            'id' => $partido->id,
            'goles_local' => $partido->goles_local,
            'goles_visitante' => $partido->goles_visitante,
            'estado' => $partido->estado,
            'equipo_local_nombre' => $partido->equipoLocal->nombre,
            'equipo_visitante_nombre' => $partido->equipoVisitante->nombre
        ]);
    }

    //Actualiza los resultados y el estado de un partido desde el modal
    public function updateResults(UpdatePartidoResultsRequest $request, Partido $partido): RedirectResponse
    {
        $partido->update($request->validated());

        return redirect()->route('partidos.index')->with('success', 'Resultados del partido actualizados exitosamente.');
    }

}
