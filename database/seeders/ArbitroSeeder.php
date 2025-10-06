<?php

namespace Database\Seeders;

use App\Models\Arbitro;
use Illuminate\Database\Seeder;

class ArbitroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arbitro::factory(4)->create();
    }
}
