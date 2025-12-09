<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePartido extends Model
{
    use HasFactory;

    protected $fillable = [
        'partido_id',
        'jugador_id',
        'equipo_id',
        'goles',
        'asistencias',
        'tarjetas_amarillas',
        'tarjetas_rojas',
        'tipo_participacion',
    ];

    // Relación inversa con Partido
    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    // Relación con Jugador (User)
    public function jugador()
    {
        return $this->belongsTo(User::class, 'jugador_id');
    }

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
