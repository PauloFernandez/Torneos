<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index()
    {
        $torneos = Torneo::withCount('equipos')
                    ->where('estado', 1)
                    ->get();
        return view('home', compact('torneos'));
    }

    public function infoTorneo($id)
    {
        $logo = '/img/logos/logoTorneo.png';
        $torneo = Torneo::findOrFail($id);

        /** guardamos en la variabel la ubicacion de nuestra vista */
        $pdf = Pdf::loadView('pdf.infoTorneo', compact('torneo', 'logo'));

        return $pdf->download('pdf.infoTorneo');
    }

    public function inscripcion()
    {
        return view('inscripcion');
    }
}
