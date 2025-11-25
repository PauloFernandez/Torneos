<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['file_uri', 'nombre', 'inscripcion_factura', 'torneo_id'];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function partidosLocal()
    {
        return $this->hasMany(Partido::class, 'equipo_local_id');
    }

    public function partidosVisitante()
    {
        return $this->hasMany(Partido::class, 'equipo_visitante_id');
    }

    // Relación muchos a muchos con usuarios
    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withPivot('posicion', 'num_camiseta')->withTimestamps();
    }
}
