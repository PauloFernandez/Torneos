<?php

namespace App\Http\Controllers\Participante;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Models\Noticia;
use App\Models\Torneo;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends Controller
{
    public function clasificaciones()
    {
        //Obtiene el usuario que está logueado en la aplicación.
        $user = auth()->user();

        /**¿Qué hace esto?**
        - Busca torneos que tengan equipos con usuarios específicos
        - Filtra para que solo encuentre torneos donde:
        - El usuario sea el que está logueado (`$user->id`)
        - Y ese usuario tenga el rol de `'jugador'`
         *Relación de modelos:*
        Torneo → tiene muchos → Equipos → tiene muchos → Usuarios → tiene muchos → Roles
         */
        $torneos = Torneo::whereHas('equipos.usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'jugador');
                });
        })
            //Cargar partidos finalizados (Eager Loading)
            ->with([
                'equipos.partidosLocal' => function ($q) {
                    $q->where('estado', 'finalizado');
                },
                'equipos.partidosVisitante' => function ($q) {
                    $q->where('estado', 'finalizado');
                }
            ])
            ->get();

        // Procesar estadísticas por equipo
        foreach ($torneos as $torneo) {
            foreach ($torneo->equipos as $equipo) {

                // Partidos
                $local = $equipo->partidosLocal;
                $visit = $equipo->partidosVisitante;

                // Inicializar estadísticas
                $PJ = $G = $E = $P = $GF = $GC = 0;

                // Partidos como LOCAL
                foreach ($local as $p) {
                    $PJ++;
                    $GF += $p->goles_local;
                    $GC += $p->goles_visitante;

                    if ($p->goles_local > $p->goles_visitante) $G++;
                    elseif ($p->goles_local == $p->goles_visitante) $E++;
                    else $P++;
                }

                // Partidos como VISITANTE
                foreach ($visit as $p) {
                    $PJ++;
                    $GF += $p->goles_visitante;
                    $GC += $p->goles_local;

                    if ($p->goles_visitante > $p->goles_local) $G++;
                    elseif ($p->goles_visitante == $p->goles_local) $E++;
                    else $P++;
                }

                // Punto + DG
                $equipo->PJ = $PJ;
                $equipo->G  = $G;
                $equipo->E  = $E;
                $equipo->P  = $P;

                $equipo->GF = $GF;
                $equipo->GC = $GC;
                $equipo->DG = $GF - $GC;
                $equipo->Pts = ($G * 3) + ($E * 1);
            }

            // Ordenar equipos dentro del torneo
            $torneo->equipos = $torneo->equipos->sortByDesc('DG')
                ->sortByDesc('Pts')
                ->values();
        }

        return view('participantes.clasificaciones', compact('torneos'));
    }

    public function equipos()
    {
        //Obtiene el usuario que está logueado en la aplicación.
        $user = auth()->user();

        // Obtener los equipos donde el usuario participa como jugador
        $equipos = Equipo::whereHas('usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id)
                ->whereHas('roles', fn($q) => $q->where('name', 'jugador'));
        })
            ->with('usuarios')
            ->get();

        // Definir orden de posiciones (de atrás hacia adelante)
        $ordenPosiciones = [
            'POR' => 1,
            'DFC' => 2,
            'LD' => 3,
            'LI' => 4,
            'MCD' => 5,
            'MC' => 6,
            'MCO' => 7,
            'ED' => 8,
            'EI' => 9,
            'SP' => 10,
            'DC' => 11,
        ];

        // Calcular estadísticas de todos los jugadores de todos los equipos en 1 query
        foreach ($equipos as $equipo) {
            $jugadoresIds = $equipo->usuarios->pluck('id');

            $stats = DB::table('detalle_partidos')
                ->join('partidos', 'detalle_partidos.partido_id', '=', 'partidos.id')
                ->where('detalle_partidos.equipo_id', $equipo->id)
                ->where('partidos.torneo_id', $equipo->torneo_id)
                ->whereIn('detalle_partidos.jugador_id', $jugadoresIds)
                ->select('detalle_partidos.jugador_id')
                ->selectRaw('COUNT(DISTINCT detalle_partidos.partido_id) as pj')
                ->selectRaw('COALESCE(SUM(goles), 0) as g')
                ->selectRaw('COALESCE(SUM(asistencias), 0) as asi')
                ->selectRaw('COALESCE(SUM(tarjetas_amarillas), 0) as ta')
                ->selectRaw('COALESCE(SUM(tarjetas_rojas), 0) as tr')
                ->groupBy('detalle_partidos.jugador_id')
                ->get()
                ->keyBy('jugador_id');

            // Asignar stats a cada jugador
            foreach ($equipo->usuarios as $jugador) {
                $s = $stats->get($jugador->id);
                $jugador->pj = $s->pj ?? 0;
                $jugador->g = $s->g ?? 0;
                $jugador->asi = $s->asi ?? 0;
                $jugador->ta = $s->ta ?? 0;
                $jugador->tr = $s->tr ?? 0;
            }

            // Ordenar jugadores por posición
            $equipo->usuarios = $equipo->usuarios->sortBy(function ($jugador) use ($ordenPosiciones) {
                return $ordenPosiciones[$jugador->pivot->posicion] ?? 999;
            })->values();
        }

        return view('participantes.equipos', compact('equipos'));
    }

    public function partidos()
    {
        //Obtiene el usuario que está logueado en la aplicación.
        $user = auth()->user();

        $torneos = Torneo::whereHas('equipos.usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'jugador');
                });
        })
            ->with([
                'partidos' => function ($q) {
                    $q->orderBy('fecha', 'desc')
                        ->orderBy('hora', 'desc');
                },
                'partidos.equipoLocal',
                'partidos.equipoVisitante',
                'partidos.cancha',
                'partidos.arbitro'
            ])
            ->get();

        return view('participantes.partidos', compact('torneos'));
    }

    public function goleadores()
    {
        $jugadoresOrdenados = $this->obtenerJugadoresOrdenados('g');
        
        return view('participantes.goleadores', compact('jugadoresOrdenados'));
    }

    public function asistencias()
    {
        $jugadoresOrdenados = $this->obtenerJugadoresOrdenados('asi');
        
        return view('participantes.asistencias', compact('jugadoresOrdenados'));
    }

    public function noticias()
    {
        $noticias = Noticia::orderBy('fecha_publicado', 'desc')->get();
        return view('participantes.noticias', compact('noticias'));
    }

    //Funciones 
    protected function obtenerJugadoresOrdenados($campoOrden)
    {
        $torneos = $this->data();
        $todosLosJugadores = collect();

        foreach ($torneos as $torneo) {
            foreach ($torneo->equipos as $equipo) {
                foreach ($equipo->usuarios as $jugador) {
                    // Añadir el nombre del equipo al jugador
                    $jugador->equipo_nombre = $equipo->nombre;
                    $todosLosJugadores->push($jugador);
                }
            }
        }

        // Ordenar por el campo especificado de mayor a menor
        return $todosLosJugadores->sortByDesc($campoOrden)->values();
    }

    protected function data()
    {
        // Obtiene el usuario que está logueado en la aplicación
        $user = auth()->user();

        $torneos = Torneo::whereHas('equipos.usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'jugador');
                });
        })
            ->with('equipos.usuarios')
            ->get();

        foreach ($torneos as $torneo) {
            foreach ($torneo->equipos as $equipo) {
                $jugadoresIds = $equipo->usuarios->pluck('id');

                $stats = DB::table('detalle_partidos')
                    ->join('partidos', 'detalle_partidos.partido_id', '=', 'partidos.id')
                    ->where('detalle_partidos.equipo_id', $equipo->id)
                    ->where('partidos.torneo_id', $equipo->torneo_id)
                    ->whereIn('detalle_partidos.jugador_id', $jugadoresIds)
                    ->select('detalle_partidos.jugador_id')
                    ->selectRaw('COALESCE(SUM(goles), 0) as g')
                    ->selectRaw('COALESCE(SUM(asistencias), 0) as asi')
                    ->groupBy('detalle_partidos.jugador_id')
                    ->get()
                    ->keyBy('jugador_id');

                // Asignar stats a cada jugador
                foreach ($equipo->usuarios as $jugador) {
                    $s = $stats->get($jugador->id);
                    $jugador->g = $s->g ?? 0;
                    $jugador->asi = $s->asi ?? 0;
                }
            }
        }
        return $torneos;
    }
}
