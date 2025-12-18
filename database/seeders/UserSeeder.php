<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Administrador
        $admin = User::create([
            'file_uri' => null,
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Administrador',
            'apellido' => 'Dueño',
            'fecha_nacimiento' => fake()->dateTimeInInterval('-40 years', '+20 years'),
            'direccion' => fake()->address,
            'telefono' => fake()->unique()->mobileNumber,
            'email' => 'admin@correo.com',
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('Administrador');

        // Usuario empleado
        $usuario = User::create([
            'file_uri' => null,
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Usuario',
            'apellido' => 'Empleado',
            'fecha_nacimiento' => fake()->dateTimeInInterval('-40 years', '+20 years'),
            'direccion' => fake()->address,
            'telefono' => fake()->unique()->mobileNumber,
            'email' => 'usuario@correo.com',
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $usuario->assignRole('Usuario');

        // Usuario Jugador
        $jugador = User::create([
            'file_uri' => null,
            'documento' => fake()->unique()->randomNumber(8),
            'name' => fake()->firstName,
            'apellido' => fake()->lastName,
            'fecha_nacimiento' => fake()->dateTimeInInterval('-40 years', '+20 years'),
            'direccion' => fake()->address,
            'telefono' => fake()->unique()->mobileNumber,
            'email' => 'jugador@correo.com',
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        //Opcion 1- Crear usuarios adicionales usando el factory y asignando el rol 'Jugador'

        $jugadores = User::factory(100)->create();
        $jugadores->each(function ($user) {
            $user->assignRole('Jugador');
        });
        
    }
}
