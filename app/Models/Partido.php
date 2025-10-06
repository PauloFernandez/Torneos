<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'hora', 'goles_visitante', 'goles_local', 'estado', 'arbitro_id', 'cancha_id', 'torneo_id', 'equipo_local_id','equipo_visitante_id'];

    protected $casts = ['fecha' => 'date'];

    public function arbitro()
    {
        return $this->belongsTo(Arbitro::class);
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }

        //ESTA ES LA RELACIÓN QUE TE FALTABA 
    // Relación con los detalles de los jugadores que participaron
    public function detalles() 
    {
        return $this->hasMany(DetallePartido::class);
    }
    
    // También puedes agregar esta relación auxiliar
    // Para obtener directamente los jugadores que participaron
    public function jugadores() //De que modelo sale
    {
        return $this->belongsToMany(User::class, 'partido_jugadores', 'partido_id', 'jugador_id')
                    ->withPivot('equipo_id', 'goles', 'asistencias', 'tarjetas_amarillas', 'tarjetas_rojas', 'tipo_participacion')
                    ->withTimestamps();
    }
}
