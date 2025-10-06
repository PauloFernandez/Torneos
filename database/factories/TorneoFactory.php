<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Torneo>
 */
class TorneoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->randomElement(['La Liga', 'Premier League', 'Serie A', 'Campeonato Uruguayo']),
            'categoria' => fake()->randomElement(['Masculino', 'Femenino', 'Mixto', 'Adolecente']),
            'fecha_inicio' => $fechaInicio = fake()->dateTimeBetween('-1 year', '+1 month'),
            'fecha_fin' => fake()->dateTimeBetween(
                $fechaInicio->format('Y-m-d') . ' +1 day',
                $fechaInicio->format('Y-m-d') . ' +1 month'
            ),
            'inscripcion' => fake()->randomFloat(2, 1000, 5000),
            'valor_cancha' => fake()->randomFloat(2, 500, 2000),
            'premio' => fake()->randomFloat(2, 1000, 10000),
            'premio_extra' => fake()->realText($maxNbChars = 100, $indexSize = 2),
            'reglas_gral' => fake()->text(200),
            'sis_competicion' => fake()->text(200),
            'requisito_jugador' => fake()->text(200),
            'disciplina' => fake()->text(200),
            'cantidad_equipos' => fake()->numberBetween(0, 255),
            'estado' => fake()->boolean(50), // 0 = inactivo, 1 = activo
        ];
    }
}
