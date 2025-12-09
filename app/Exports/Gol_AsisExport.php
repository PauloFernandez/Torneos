<?php

namespace App\Exports;

use App\Models\Torneo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class Gol_AsisExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{

    public function collection()
    {
        $torneos = Torneo::where('estado', 1)->with('equipos.usuarios')->get();

        // Colección para almacenar todas las filas del Excel
        $filas = new Collection();

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

                foreach ($equipo->usuarios as $jugador) {
                    $s = $stats->get($jugador->id);
                    $jugador->g = $s->g ?? 0;
                    $jugador->asi = $s->asi ?? 0;

                }

                foreach ($equipo->usuarios as $jugador) {
                    // Agregar información del torneo y equipo
                    $jugador->torneo_nombre = $equipo->torneo->nombre;
                    $jugador->equipo_nombre = $equipo->nombre;
                    $filas->push($jugador);
                }
            }
        }

        return $filas;
    }

    public function headings(): array
    {
        return [
            'Torneo',
            'Equipo',
            'Jugador',
            'Goles',
            'Asist.'
        ];
    }

    public function map($jugador): array
    {
        return [
            $jugador->torneo_nombre ?? '',
            $jugador->equipo_nombre ?? '',
            $jugador->name . ' ' . $jugador->apellido ?? '',
            $jugador->g ?? '',
            $jugador->asi ?? '',
        ];
    }
}
