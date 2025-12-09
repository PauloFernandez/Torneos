<?php

namespace App\Exports;

use App\Models\Equipo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class EquipoExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{

    public function collection()
    {
        
        $equipos = Equipo::whereHas('torneo', function ($query) {
            $query->where('estado', 1);
        })
            ->with(['usuarios', 'torneo'])
            ->get();

        // Colección para almacenar todas las filas del Excel
        $filas = new Collection();

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

        // Procesar cada equipo
        foreach ($equipos as $equipo) {
            $jugadoresIds = $equipo->usuarios->pluck('id');

            // Calcular estadísticas de los jugadores del equipo
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
                
                // Agregar información del torneo y equipo
                $jugador->torneo_nombre = $equipo->torneo->nombre;
                $jugador->equipo_nombre = $equipo->nombre;
                
                // Asignar la posición del jugador (no el array completo)
                $jugador->posicion_codigo = $jugador->pivot->posicion;
            }

            // Ordenar jugadores por posición
            $jugadoresOrdenados = $equipo->usuarios->sortBy(function ($jugador) use ($ordenPosiciones) {
                return $ordenPosiciones[$jugador->pivot->posicion] ?? 999;
            })->values();

            // Agregar jugadores a la colección
            foreach ($jugadoresOrdenados as $jugador) {
                $filas->push($jugador);
            }
        }

        return $filas;
    }

    public function headings(): array
    {
        return [
            'TORNEO',
            'EQUIPO',
            'POS',
            'Nº CAMISETA',
            'JUGADOR',
            'PJ',
            'G',
            'ASI',
            'T.A',
            'T.R',
        ];
    }

    public function map($jugador): array
    {
        return [
            $jugador->torneo_nombre ?? '',
            $jugador->equipo_nombre ?? '',
            $jugador->posicion_codigo ?? '',
            $jugador->pivot->num_camiseta ?? '',
            $jugador->name . ' ' . $jugador->apellido ?? '',
            $jugador->pj ?? 0,
            $jugador->g ?? 0,
            $jugador->asi ?? 0,
            $jugador->ta ?? 0,
            $jugador->tr ?? 0,
        ];
    }
}
