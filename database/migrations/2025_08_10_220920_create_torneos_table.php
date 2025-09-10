<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('categoria',['Masculino', 'Femenino', 'Mixto', 'Adolecente']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedDecimal('inscripcion', 10, 2);
            $table->unsignedDecimal('valor_cancha', 10, 2);
            $table->unsignedDecimal('premio', 10, 2);
            $table->string('premio_extra')->nullable();
            $table->text('reglas_gral')->nullable();
            $table->text('sis_competicion')->nullable();
            $table->text('requisito_jugador')->nullable();
            $table->text('disciplina')->nullable();
            $table->unsignedTinyInteger('cantidad_equipos')->nullable()->default(0); // almacenar valores desde 0 hasta 255 (solo 256 valores posibles).
            $table->boolean('estado')->default(0); // 0 = inactivo, 1 = activo 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
