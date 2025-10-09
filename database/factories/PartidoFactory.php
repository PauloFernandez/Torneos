<?php

namespace Database\Factories;

use App\Models\Arbitro;
use App\Models\Cancha;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partido>
 */
class PartidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $torneo = Torneo::inRandomOrder()->first();
        $equipos = $torneo->equipos()->inRandomOrder()->take(2)->pluck('id');

        return [
            'fecha' => fake()->date($format = 'Y-m-d', $min = 'now'),
            'hora' => fake()->time($format = 'H:i:s', $min = 'now'),
            'goles_local' => fake()->numberBetween(0, 5),
            'goles_visitante' => fake()->numberBetween(0, 5),
            'estado' => fake()->randomElement(['programado', 'finalizado', 'suspendido', 'cancelado']),
            'arbitro_id' => Arbitro::inRandomOrder()->first()->id,
            'cancha_id' => Cancha::inRandomOrder()->first()->id,
            'torneo_id' => $torneo->id,
            'equipo_local_id' => $equipos[0],
            'equipo_visitante_id' => $equipos[1],
        ];
    }
}
