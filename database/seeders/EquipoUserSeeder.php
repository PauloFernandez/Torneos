<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('Jugador')->get();
        $equipos = Equipo::all();

        foreach ($users as $user) {
            $user->equipos()->attach($equipos->random()->id, [
                'posicion' => fake()->randomElement(['POR', 'DFC', 'LD', 'LI', 'MCD', 'MC', 'MCO', 'ED', 'EI', 'SP', 'DC']),
                'num_camiseta' => fake()->numberBetween(1, 10),
            ]);
        }
    }
}
