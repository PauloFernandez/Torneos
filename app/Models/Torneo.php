<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Carbon; // Asegúrate de importar Carbon

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'inscripcion',
        'valor_cancha',
        'fecha_inicio',
        'fecha_fin',
        'cantidad_equipos',
        'categoria',
        'premio',
        'premio_extra',
        'reglas_gral',
        'sis_competicion',
        'requisito_jugador',
        'disciplina',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'date', // o 'datetime' si usaras hora también
        'fecha_fin' => 'date',
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
