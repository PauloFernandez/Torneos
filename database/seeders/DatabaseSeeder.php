<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermisoSeeder::class,
            RolSeeder::class,
            UserSeeder::class,
            NoticiaSeeder::class,
            ArbitroSeeder::class,
            CanchaSeeder::class,
            TarjetaSeeder::class,
            TorneoSeeder::class,
            EquipoSeeder::class,
            EquipoUserSeeder::class,
            PartidoSeeder::class,
        ]);
    }
}
