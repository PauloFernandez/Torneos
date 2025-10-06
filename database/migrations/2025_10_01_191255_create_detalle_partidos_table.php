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
        Schema::create('detalle_partidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('partido_id')->constrained()->onDelete('cascade');
            $table->foreignId('jugador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('goles')->default(0);
            $table->tinyInteger('asistencias')->default(0);
            $table->tinyInteger('tarjetas_amarillas')->default(0);
            $table->tinyInteger('tarjetas_rojas')->default(0);
            $table->enum('tipo_participacion', ['titular', 'suplente'])->nullable()->default(null);

            $table->timestamps();

            // Evitar duplicados
            $table->unique(['partido_id', 'jugador_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_partidos');
    }
};
