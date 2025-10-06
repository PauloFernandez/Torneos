<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Arbitro extends Model
{
    use HasFactory;

    protected $fillable = ['documento', 'nombre', 'apellido', 'fecha_nac', 'direccion', 'telefono', 'email'];

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    protected $casts = [
        'fecha_nac' => 'date', // o 'datetime' si usaras hora también
    ];
}
