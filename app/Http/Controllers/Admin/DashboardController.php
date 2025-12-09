<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ClasificacionExport;
use App\Exports\EquipoExport;
use App\Exports\Gol_AsisExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function torneos()
    {
        $data = DB::table('equipo_user')
            ->join('equipos', 'equipo_user.equipo_id', '=', 'equipos.id')
            ->selectRaw('COUNT(DISTINCT equipo_id) AS equipos')
            ->selectRaw('COUNT(user_id) AS jugadores')
            ->selectRaw('COUNT(DISTINCT torneo_id) AS torneos')
            ->selectRaw('(SELECT COUNT(*) FROM partidos WHERE estado = "finalizado") AS jugados')
            ->get();

        return view('admin.dashboard', compact('data'));
    }

    public function exportClasificacionAll() 
    {
        return Excel::download(new ClasificacionExport, 'TablaClasificaciones.xlsx');
    }

    public function exportEquiposAll() 
    {
        return Excel::download(new EquipoExport, 'TablaPorEquipos.xlsx');
    }

    public function exportGolAsisAll() 
    {
        return Excel::download(new Gol_AsisExport, 'TablaGolAsist.xlsx');
    }
}
