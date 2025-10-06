<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'Crear',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'Editar',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'Ver',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'Eliminar',
            'guard_name' => 'web'
        ]);
    }
}
