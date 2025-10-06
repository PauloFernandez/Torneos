<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('partidos', function (Blueprint $table) {
        $table->id();
        // Información básica del partido
        $table->date('fecha');
        $table->time('hora');
        $table->integer('goles_local')->nullable(); // Goles anotados por el equipo local (nullable hasta que el partido se juegue)
        $table->integer('goles_visitante')->nullable(); // Goles anotados por el equipo visitante (nullable hasta que el partido se juegue)
        $table->enum('estado', ['programado', 'finalizado', 'suspendido', 'cancelado'])->default('programado'); // Estado del partido

        $table->foreignId('arbitro_id')->nullable()->constrained('arbitros')->onDelete('set null'); // Si se elimina un árbitro, el partido no se elimina, solo se indica que no hay árbitro asignado
        $table->foreignId('cancha_id')->constrained('canchas')->onDelete('restrict'); // Si se elimina una cancha, el partido NO se elimina
        $table->foreignId('torneo_id')->constrained('torneos')->onDelete('cascade'); // Un partido pertenece a un torneo
        // Equipos contendientes (local y visitante)
        $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade'); // Si se elimina el equipo, se elimina el partido
        $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade'); // Si se elimina el equipo, se elimina el partido

        $table->timestamps();

        // Restricciones únicas para evitar partidos duplicados (misma fecha, hora y equipos)
        $table->unique(
            ['torneo_id', 'equipo_local_id', 'equipo_visitante_id', 'fecha', 'hora'],
            'partidos_unique_key'
        );
        // Para asegurar que los equipos no jueguen dos veces en el mismo orden a la misma hora en el mismo torneo.
        // Si necesitas que no puedan jugar el mismo partido invirtiendo el orden de local/visitante,
        // tendrías que manejarlo a nivel de aplicación o con una restricción más compleja.
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
