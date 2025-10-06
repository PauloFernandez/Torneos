<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_uri',
        'documento',
        'name',
        'apellido',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'email',
        'estado',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'fecha_nacimiento' => 'date', // o 'datetime' si usaras hora también
    ];

    public function noticias(): HasMany
    {
        return $this->hasMany(Noticia::class);
    }

    // Relación muchos a muchos con equipos
    public function equipos()
    {
        return $this->belongsToMany(Equipo::class)->withPivot('posicion', 'num_camiseta')->withTimestamps();
    }

    public function partidosJugados()
    {
        return $this->belongsToMany(Partido::class, 'partido_jugadores', 'jugador_id', 'partido_id')
            ->withPivot('equipo_id', 'goles', 'asistencias', 'tarjetas_amarillas', 'tarjetas_rojas', 'tipo_participacion')
            ->withTimestamps();
    }

    //Relación con detalles de partidos (más directa)
    public function detallesPartidos()
    {
        return $this->hasMany(DetallePartido::class, 'jugador_id');
    }

    // ⭐ NUEVA: Relación con sanciones
    /* Pendiente
    public function sanciones()
    {
        return $this->hasMany(Sancion::class, 'jugador_id');
    }
    */
}
