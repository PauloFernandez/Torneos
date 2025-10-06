<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_uri' => null,
            'documento' => fake()->unique()->randomNumber(8),
            'name' => fake()->firstName,
            'apellido' => fake()->lastName,
            'fecha_nacimiento' => fake()->dateTimeInInterval('-40 years', '+20 years'),
            'direccion' => fake()->secondaryAddress,
            'telefono' => fake()->unique()->mobileNumber,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'), 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
