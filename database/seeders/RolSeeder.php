<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Usuario',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Jugador',
            'guard_name' => 'web'
        ]);
    }
}
