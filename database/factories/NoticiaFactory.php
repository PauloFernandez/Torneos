<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(),
            'descripcion' => fake()->paragraph(3),
            'fecha_publicado' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'autor_id' => fake()->randomElement(
                                \App\Models\User::role(['Administrador', 'Usuario'])->pluck('id')
                            ),
        ];
    }
}
