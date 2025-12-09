<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Carbon;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_publicado',
        'autor_id',
    ];

    public function user(): BelongsTo
    {
        //Se especifica la columna 'autor_id' porque no es igual a la columna "id" que tiene la tabla User
        return $this->belongsTo(User::class, 'autor_id');
    }

    protected $casts = [
        'fecha_publicado' => 'date', // o 'datetime' si usaras hora también
    ];
}
