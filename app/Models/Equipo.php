<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['file_uri', 'nombre', 'estado', 'torneo_id'];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    // Relación muchos a muchos con usuarios
    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withPivot('posicion', 'num_camiseta')->withTimestamps();
    }
}
