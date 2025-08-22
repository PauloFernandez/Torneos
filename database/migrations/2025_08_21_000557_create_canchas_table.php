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
        Schema::create('canchas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo_superficie', ['cesped_natural', 'cesped_artificial', 'otro']);
            $table->enum('estado', ['disponible', 'ocupada', 'mantenimiento']);
            $table->decimal('precio_por_hora', 8, 2);
            $table->boolean('techada')->default(0);
            $table->boolean('iluminacion')->default(0);
            $table->boolean('vestuario')->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas');
    }
};
