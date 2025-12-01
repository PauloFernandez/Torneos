<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JugadoresExport implements FromArray, WithHeadings
{
   public function headings(): array
    {
        return [
            'documento',
            'name',
            'apellido',
            'fecha_nacimiento',
            'direccion',
            'telefono',
            'email',
            'posicion',
            'num_camiseta',
        ];
    }

    public function array(): array
    {
        return []; // sin registros, solo encabezados
    } 
}
