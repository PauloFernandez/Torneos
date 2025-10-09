<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Torneo;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Opcion automatica
        //Equipo::factory(50)->create();

        //Opcion manual para crear equipos de torneos especificos
        $torneos = Torneo::all(); // Obtenemos todos los torneos disponibles

        //Equipos de "La Liga"
        Equipo::create([
            'file_uri' => 'Barcelona.png',
            'nombre' => 'FC Barcelona',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id, // Asignamos el Id del torneo segun el nombre que indicamos
        ]);

        Equipo::create([
            'file_uri' => 'Real_Madrid.png',
            'nombre' => 'Real Madrid CF',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Atletico_de_Madrid.png',
            'nombre' => 'Atlético de Madrid',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Sevilla.png',
            'nombre' => 'Sevilla FC',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Real_Sociedad.png',
            'nombre' => 'Real Sociedad',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Betis.png',
            'nombre' => 'Real Betis Balompié',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Valencia.png',
            'nombre' => 'Valencia CF',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Athletic_Bilbao.png',
            'nombre' => 'Athletic Club de Bilbao',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);


        Equipo::create([
            'file_uri' => 'Villarreal.png',
            'nombre' => 'Villarreal CF',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Celta.png',
            'nombre' => 'RC Celta de Vigo',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'La Liga')->first()->id,
        ]);

        //Equipos de "Premier League"
        Equipo::create([
            'file_uri' => 'Arsenal.png',
            'nombre' => 'Arsenal',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Liverpool.png',
            'nombre' => 'Liverpool',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Manchester_city.png',
            'nombre' => 'Manchester City',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Manchester_united.png',
            'nombre' => 'Manchester United',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Aston_villa.png',
            'nombre' => 'Aston Villa',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Tottenham.png',
            'nombre' => 'Tottenham Hotspur',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Newcastle.png',
            'nombre' => 'Newcastle United',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Chelsea.png',
            'nombre' => 'Chelsea',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Crystal_palace.png',
            'nombre' => 'Crystal Palace',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Brentford.png',
            'nombre' => 'Brentford',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Premier League')->first()->id,
        ]);

        //Equipos de "Serie A"
        Equipo::create([
            'file_uri' => 'Juventus.png',
            'nombre' => 'Juventus',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Inter_milan.png',
            'nombre' => 'Inter de Milan',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'AC_milan.png',
            'nombre' => 'AC Milan',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Napoli.png',
            'nombre' => 'Napoli',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'AS_Roma.png',
            'nombre' => 'AS Roma',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Lazio.png',
            'nombre' => 'Lazio',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Atalanta.png',
            'nombre' => 'Atalanta',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Fiorentina.png',
            'nombre' => 'Fiorentina',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Udinese.png',
            'nombre' => 'Udinese',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Torino.png',
            'nombre' => 'Torino',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Serie A')->first()->id,
        ]);

        //Equipos de "Campeonato Uruguayo"
        Equipo::create([
            'file_uri' => 'Penarol.png',
            'nombre' => 'Peñarol',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Nacional.png',
            'nombre' => 'Nacional',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);


        Equipo::create([
            'file_uri' => 'Cerro.png',
            'nombre' => 'Cerro',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Boston_river.png',
            'nombre' => 'Boston River',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Progreso.png',
            'nombre' => 'Progreso',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Danubio.png',
            'nombre' => 'Danubio',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Defensor.png',
            'nombre' => 'Defensor Sporting',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'River_plate.png',
            'nombre' => 'River Plate',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Montevideo_Torque.png',
            'nombre' => 'Montevideo City Torque',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);

        Equipo::create([
            'file_uri' => 'Wanderers.png',
            'nombre' => 'Wanderers',
            'inscripcion_factura' => 'Pendiente',
            'torneo_id' => $torneos->where('nombre', 'Campeonato Uruguayo')->first()->id,
        ]);
    }
}
