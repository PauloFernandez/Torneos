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
        Schema::create('equipo_user', function (Blueprint $table) {
            $table->id();
            $table->enum('posicion', ['POR', 'DFC', 'LD', 'LI', 'MCD', 'MC', 'MCO', 'ED', 'EI', 'SP', 'DC'])->nullable();
            $table->string('num_camiseta')->nullable();

            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();

            // Asegurar que un usuario no esté duplicado en el mismo equipo
            $table->unique(['user_id', 'equipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_user');
    }
};
