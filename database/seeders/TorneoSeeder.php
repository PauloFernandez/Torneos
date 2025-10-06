<?php

namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Seeder;


class TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Torneo::factory(4)->create();
    }
}
