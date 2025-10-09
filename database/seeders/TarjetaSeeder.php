<?php

namespace Database\Seeders;

use App\Models\Tarjeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarjeta::create([
            'nombre' => 'Amarilla',
            'multa' => 150
        ]);
        Tarjeta::create([
            'nombre' => 'Roja',
            'multa' => 250
        ]);
    }
}
