<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arbitro>
 */
class ArbitroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'documento' => fake()->unique()->randomNumber(8),
            'nombre' => fake()->firstName,
            'apellido' => fake()->lastName,
            'fecha_nac' => fake()->date,
            'direccion' => fake()->address,
            'telefono' => fake()->unique()->mobileNumber,
            'email' => fake()->unique()->freeEmail,
        ];
    }
}
