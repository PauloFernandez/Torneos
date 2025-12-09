<?php

namespace App\Http\Controllers\csv;

use App\Http\Controllers\Controller;
use App\Exports\JugadoresExport;
use App\Imports\JugadorImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CSV_JugadoresController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('document_csv');
        
        if ($file != "") {
            Excel::import(new JugadorImport, $file);
            return redirect()->route('usuarios.index')->with('success', 'Usuarios creados exitosamente.');
        } else {
            return redirect()->route('usuarios.index')->with('danger', 'Seleccione un Archivo');
        }

    }

    public function export()
    {
        return Excel::download(new JugadoresExport, 'jugadores.csv');
    }
}
