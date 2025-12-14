<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JugadorRequest;
use App\Models\User;
use App\Models\Equipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EquipoUserController extends Controller
{
    /**
     * Mostrar jugadores pertenecientes a un equipo
     */
    public function index(): View
    {
        // Obtener todos los jugadores que tienen equipos asignados
        $jugadores = User::query()
            ->role('jugador')
            ->whereHas('equipos') // Solo jugadores que tienen equipos
            ->when(request('search'), function ($buscar) {
                return $buscar->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('apellido', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('nombre', 'LIKE', '%' . request('search') . '%');
            })
            ->with(['equipos' => function ($query) {
                $query->withPivot('posicion', 'num_camiseta');
            }])
            ->join('equipo_user', 'users.id', '=', 'equipo_user.user_id')
            ->join('equipos', 'equipo_user.equipo_id', '=', 'equipos.id')
            ->orderBy('equipos.nombre')
            ->orderBy('users.apellido')
            ->select('users.*') // Importante: solo seleccionar columnas de users
            ->paginate(5)
            ->withQueryString();

        return view('admin.jugadores.index', compact('jugadores'));
    }

    /**
     * Mostrar formulario para asignar jugador a equipo
     */
    public function create(): View
    {
        $equipos = Equipo::all();
        // Obtener jugadores disponibles (con rol jugador) que NO tengan equipo asignado
        $jugadores = User::query()->role('jugador')->when(request('search'), function ($query) {
            // Agrupar las condiciones de búsqueda en un closure
            return $query->where(function ($subQuery) {
                $subQuery->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('apellido', 'LIKE', '%' . request('search') . '%');
            });
        })->where('estado', 'activo')->whereDoesntHave('equipos') // Excluir jugadores que ya tienen equipo
            ->orderBy('apellido')->paginate(5)->withQueryString();

        return view('admin.jugadores.create', compact('equipos', 'jugadores'));
    }

    /**
     * Asignar un jugador a un equipo
     */
    public function store(JugadorRequest $request): RedirectResponse
    {
        // Validar que se haya seleccionado al menos un jugador
        $jugadoresSeleccionados = collect($request->jugadores ?? [])
            ->filter(function ($jugador) {
                return isset($jugador['seleccionado']);
            });

        if ($jugadoresSeleccionados->isEmpty()) {
            return back()
                ->withErrors(['jugadores_seleccionados' => 'Debe seleccionar al menos un jugador.'])
                ->withInput();
        }

        $equipo = Equipo::findOrFail($request->equipo_id);

        // Obtener números de camiseta ya ocupados en el equipo
        $camisetasOcupadas = $equipo->usuarios()
            ->whereNotNull('equipo_user.num_camiseta')
            ->pluck('equipo_user.num_camiseta')
            ->toArray();

        // Validar números de camiseta duplicados entre los jugadores seleccionados
        $camisetasNuevas = [];
        $errores = [];

        foreach ($request->jugadores as $index => $jugador) {
            if (isset($jugador['seleccionado'])) {
                $numCamiseta = $jugador['num_camiseta'];

                if ($numCamiseta) {
                    // Verificar si la camiseta ya existe en el equipo
                    if (in_array($numCamiseta, $camisetasOcupadas)) {
                        $errores["jugadores.{$index}.num_camiseta"] = "El número de camiseta {$numCamiseta} ya está ocupado en este equipo.";
                    }
                    // Verificar si la camiseta está duplicada entre los jugadores seleccionados
                    elseif (in_array($numCamiseta, $camisetasNuevas)) {
                        $errores["jugadores.{$index}.num_camiseta"] = "El número de camiseta {$numCamiseta} está duplicado en su selección.";
                    } else {
                        $camisetasNuevas[] = $numCamiseta;
                    }
                }
            }
        }

        // Si hay errores de validación, regresar con errores
        if (!empty($errores)) {
            return back()
                ->withErrors($errores)
                ->withInput();
        }

        foreach ($request->jugadores as $jugador) {
            if (isset($jugador['seleccionado'])) {
                // Verificar si el jugador ya está en este equipo
                if (!$equipo->usuarios()->where('user_id', $jugador['user_id'])->exists()) {
                    $equipo->usuarios()->attach($jugador['user_id'], [
                        'num_camiseta' => $jugador['num_camiseta'],
                        'posicion' => $jugador['posicion'],
                    ]);
                }
            }
        }

        return redirect()->route('jugadores.index')->with('success', 'Jugadores asignados al equipo exitosamente.');
    }

    /**
     * Mostrar formulario para editar datos del jugador en el equipo
     */
    public function edit(User $jugador, Equipo $equipo): View
    {
        // Verificar que el usuario esté en el equipo
        $pivotData = $equipo->usuarios()
            ->where('user_id', $jugador->id)
            ->first();

        // Obtener todos los equipos para poder cambiar de equipo si es necesario
        $equipos = Equipo::all();

        return view('admin.jugadores.edit', compact('equipo', 'jugador', 'pivotData', 'equipos'));
    }

    /**
     * Actualizar datos del pivote (posición, número de camiseta, equipo)
     */
    public function update(JugadorRequest $request, User $jugador): RedirectResponse
    {
        // Obtenemos el equipo actual (si existe)
        $equipoActual = $jugador->equipos()->first();

        // Si ya está en el mismo equipo, solo actualizamos los datos pivote
        if ($equipoActual && $equipoActual->id == $request->equipo_id) {
            $jugador->equipos()->updateExistingPivot($request->equipo_id, [
                'posicion' => $request->posicion,
                'num_camiseta' => $request->num_camiseta,
            ]);
        } else {
            // Está en un equipo distinto o sin equipo: quitamos todos y lo agregamos al nuevo
            $jugador->equipos()->detach();

            $jugador->equipos()->attach($request->equipo_id, [
                'posicion' => $request->posicion,
                'num_camiseta' => $request->num_camiseta,
            ]);
        }

        return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado exitosamente.');
    }

    /**
     * Remover un jugador de un equipo
     */
    public function destroy(Equipo $equipo, User $jugador)
    {
        // Remover jugador del equipo
        $jugador->equipos()->detach($equipo->id);

        return redirect()->route('jugadores.index')->with('danger', 'Jugador removido del equipo exitosamente.');
    }
}
