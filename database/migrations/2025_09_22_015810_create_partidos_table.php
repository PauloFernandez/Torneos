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
        $table->enum('estado', ['programado', 'finalizado', 'suspendido', 'cancelado'])->default('programado');

        $table->foreignId('arbitro_id')->nullable()->constrained('arbitros')->onDelete('restrict');
        $table->foreignId('cancha_id')->constrained('canchas')->onDelete('restrict');
        $table->foreignId('torneo_id')->constrained('torneos')->onDelete('cascade'); 

        // Equipos contendientes (local y visitante)
        $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
        $table->integer('goles_local')->nullable();
        $table->boolean('pago_cancha_local')->default(false);
        $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade');
        $table->integer('goles_visitante')->nullable();
        $table->boolean('pago_cancha_visitante')->default(false);

        $table->timestamps();

        // Restricciones únicas para evitar partidos duplicados (misma fecha, hora y equipos)
        $table->unique(
            ['torneo_id', 'equipo_local_id', 'equipo_visitante_id', 'fecha', 'hora'],
            'partidos_unique_key'
        );

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
