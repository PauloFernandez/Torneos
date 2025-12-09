<?php

namespace App\Exports;

use App\Models\Torneo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ClasificacionExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{

    public function collection()
    {

        $torneos = Torneo::where('estado', 1)
            ->with([
                'equipos.partidosLocal' => function ($q) {
                    $q->where('estado', 'finalizado');
                },
                'equipos.partidosVisitante' => function ($q) {
                    $q->where('estado', 'finalizado');
                }
            ])
            ->get();

        // Colección para almacenar todas las filas del Excel
        $filas = new Collection();

        // Procesar estadísticas por equipo
        foreach ($torneos as $torneo) {
            $posicion = 1; // Reiniciar posición para cada torneo

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
                $equipo->SG = $GF - $GC;
                $equipo->Pts = ($G * 3) + ($E * 1);

                $equipo->torneo_nombre = $torneo->nombre ?? 'Sin nombre';
            }

            // Ordenar equipos dentro del torneo
            $equiposOrdenados = $torneo->equipos->sortByDesc('Pts')
                ->sortByDesc('SG')
                ->sortByDesc('GF')
                ->values();

            // Asignar posición y agregar a la colección
            foreach ($equiposOrdenados as $equipo) {
                $equipo->posicion = $posicion++;
                $filas->push($equipo);
            }
        }

        return $filas;
    }

    public function headings(): array
    {
        return [
            'TORNEO',
            'POS',
            'EQUIPO',
            'P.J',
            'G',
            'E',
            'P',
            'GF',
            'GC',
            'SG',
            'PTOS',
        ];
    }

    public function map($equipo): array
    {
        // Si es un separador, retornar fila vacía
        if (isset($equipo->es_separador)) {
            return ['', '', '', '', '', '', '', '', '', '', ''];
        }

        return [
            $equipo->torneo_nombre ?? '',
            $equipo->posicion ?? 0,
            $equipo->nombre ?? '',
            $equipo->PJ ?? 0,
            $equipo->G ?? 0,
            $equipo->E ?? 0,
            $equipo->P ?? 0,
            $equipo->GF ?? 0,
            $equipo->GC ?? 0,
            $equipo->SG ?? 0,
            $equipo->Pts ?? 0,
        ];
    }
}
