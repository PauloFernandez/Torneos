<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cancha>
 */
class CanchaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name,
            'tipo_superficie' => fake()->randomElement(['cesped_natural', 'cesped_artificial', 'otro']),
            'estado' => fake()->randomElement(['disponible', 'ocupada', 'mantenimiento']),
            'precio_por_hora' => fake()->randomFloat(2, 1000, 3500),
            'techada' => fake()->boolean(50),
            'iluminacion' => fake()->boolean(80),
            'vestuario' => fake()->boolean(90),
            'observaciones' => fake()->text(155),
        ];
    }
}
