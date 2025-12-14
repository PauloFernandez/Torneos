<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DetallePartidoRequest;
use App\Models\Partido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DetallePartidoController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $detallePartidos = Partido::query()
            ->when($search, function ($query) use ($search) {
                return $query->orWhereHas('equipoLocal', function ($q) use ($search) {
                        $q->where('nombre', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('equipoVisitante', function ($q) use ($search) {
                        $q->where('nombre', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('torneo', function ($q) use ($search) {
                        $q->where('nombre', 'LIKE', '%' . $search . '%');
                    });
            })
            ->where('estado', 'finalizado')
            ->with(['equipoLocal', 'equipoVisitante', 'torneo'])
            ->orderBy('fecha', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admin.detallePartidos.index', compact('detallePartidos'));
    }

    public function show(Partido $detallePartido): View
    {
        $detallePartido->load(['equipoLocal', 'equipoVisitante', 'torneo', 'detalles.jugador.equipos', 'detalles.equipo']);
        return view('admin.detallePartidos.show', compact('detallePartido'));
    }

    public function edit(Partido $detallePartido): View
    {
        // Obtener jugadores de ambos equipos
        $jugadoresLocal = $detallePartido->equipoLocal->usuarios()
            ->withPivot('posicion', 'num_camiseta')
            ->get();

        $jugadoresVisitante = $detallePartido->equipoVisitante->usuarios()
            ->withPivot('posicion', 'num_camiseta')
            ->get();

        return view('admin.detallePartidos.edit', compact('detallePartido', 'jugadoresLocal', 'jugadoresVisitante'));
    }

    public function update(DetallePartidoRequest $request, Partido $detallePartido): RedirectResponse
    {
        DB::transaction(function () use ($detallePartido, $request) {
            // Eliminar detalles anteriores si existen
            $detallePartido->detalles()->delete();

            // Obtener IDs de jugadores seleccionados
            $jugadoresSeleccionados = $request['jugadores_seleccionados'];

            foreach ($request['jugadores'] as $jugadorId => $jugador) {
                // Verificar si el jugador fue seleccionado
                if (!in_array($jugador['jugador_id'], $jugadoresSeleccionados)) {
                    continue; // Saltar este jugador
                }

                // Guardar el detalle del jugador seleccionado
                $detallePartido->detalles()->create([
                    'jugador_id' => $jugador['jugador_id'],
                    'equipo_id' => $jugador['equipo_id'],
                    'goles' => $jugador['goles'] ?? 0,
                    'asistencias' => $jugador['asistencias'] ?? 0,
                    'tarjetas_amarillas' => $jugador['tarjetas_amarillas'] ?? 0,
                    'tarjetas_rojas' => $jugador['tarjetas_rojas'] ?? 0,
                    'tipo_participacion' => $jugador['tipo_participacion'],
                ]);
                
            }
        });

        return redirect()->route('detallePartidos.index')
            ->with('success', 'Detalles del partido guardados correctamente');
    }

    public function destroy(Partido $detallePartido)
    {
        $detallePartido->detalles()->delete();
        $detallePartido->delete();
        return back()->with('danger', 'Partido eliminado exitosamente.');
    }
}
