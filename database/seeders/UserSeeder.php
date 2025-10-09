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
            'name' => 'Administrativo',
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

        //opcion 2 - Crear usuarios con rol 'Jugador' de forma manual
        /* 
        //La Liga
        $jugador = User::create([
            'file_uri' => 'Marc-Andre_ter-stegen.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Marc-André',
            'apellido' => 'ter Stegen',
            'fecha_nacimiento' => '1992-4-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');


        $jugador = User::create([
            'file_uri' => 'Gerard-pique.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gerard',
            'apellido' => 'Piqué',
            'fecha_nacimiento' => '1987-02-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Sergio-busquets.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sergio',
            'apellido' => 'Busquets',
            'fecha_nacimiento' => '1988-07-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Frenkie-de-jong.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Frenkie',
            'apellido' => 'de Jong',
            'fecha_nacimiento' => '1997-05-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),

        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Pedro-Gonzalez-Lopez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pedro',
            'apellido' => 'González López',
            'fecha_nacimiento' => '2002-11-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),

        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Robert-lewandowski.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Robert',
            'apellido' => 'Lewandowski',
            'fecha_nacimiento' => '1988-08-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Ousmane-dembele.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ousmane',
            'apellido' => 'Dembélé',
            'fecha_nacimiento' => '1997-05-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Lionel-messi.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lionel',
            'apellido' => 'Messi',
            'fecha_nacimiento' => '1987-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Ansu-fati.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ansu',
            'apellido' => 'Fati',
            'fecha_nacimiento' => '2002-10-31',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'jordi-alba.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jordi',
            'apellido' => 'Alba',
            'fecha_nacimiento' => '1989-03-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Thibaut-courtois.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Thibaut',
            'apellido' => 'Courtois',
            'fecha_nacimiento' => '1992-05-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Dani_carvajal.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dani',
            'apellido' => 'Carvajal',
            'fecha_nacimiento' => '1992-01-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Eder-militao.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Éder',
            'apellido' => 'Militão',
            'fecha_nacimiento' => '1998-01-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'David-alaba.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'Alaba',
            'fecha_nacimiento' => '1992-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Ferland-mendy.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ferland',
            'apellido' => 'Mendy',
            'fecha_nacimiento' => '1995-06-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Carlos_casemiro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Casemiro',
            'fecha_nacimiento' => '1992-02-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Luka_modric.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luka',
            'apellido' => 'Modrić',
            'fecha_nacimiento' => '1985-09-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Toni_kroos.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Toni',
            'apellido' => 'Kroos',
            'fecha_nacimiento' => '1990-01-04',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Karim_benzema.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Karim',
            'apellido' => 'Benzema',
            'fecha_nacimiento' => '1987-12-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'vinicius-Junior.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Vinícius',
            'apellido' => 'Júnior',
            'fecha_nacimiento' => '2000-07-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Jan_oblak.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jan',
            'apellido' => 'Oblak',
            'fecha_nacimiento' => '1993-01-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Kieran_trippier.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kieran',
            'apellido' => 'Trippier',
            'fecha_nacimiento' => '1990-09-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Jose_jimenez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Jiménez',
            'fecha_nacimiento' => '1995-01-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Stefan_savic.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Stefan',
            'apellido' => 'Savić',
            'fecha_nacimiento' => '1991-01-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Renan_lodi.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Renan',
            'apellido' => 'Lodi',
            'fecha_nacimiento' => '1998-04-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Rodrigo_de-paul.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodrigo',
            'apellido' => 'De Paul',
            'fecha_nacimiento' => '1994-05-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Jorge_koke.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jorge',
            'apellido' => 'Resurrección Merodio (Koke)',
            'fecha_nacimiento' => '1992-01-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Angel_correa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ángel',
            'apellido' => 'Correa',
            'fecha_nacimiento' => '1995-03-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Luis_suarez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luis',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1987-01-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Joao-felix.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'João',
            'apellido' => 'Félix',
            'fecha_nacimiento' => '1999-11-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'bounou.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Yassine',
            'apellido' => 'Bounou',
            'fecha_nacimiento' => '1991-04-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'navas.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jesús',
            'apellido' => 'Navas',
            'fecha_nacimiento' => '1985-11-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kounde.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jules',
            'apellido' => 'Koundé',
            'fecha_nacimiento' => '1998-11-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');


        $jugador = User::create([
            'file_uri' => 'coutinho.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Diego',
            'apellido' => 'Carlos',
            'fecha_nacimiento' => '1993-03-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'acuna.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Marcos',
            'apellido' => 'Acuña',
            'fecha_nacimiento' => '1991-10-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'paredes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Leandro',
            'apellido' => 'Paredes',
            'fecha_nacimiento' => '1994-06-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'fernando.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Fernando',
            'apellido' => 'Reges',
            'fecha_nacimiento' => '1992-07-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'rakitic.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ivan',
            'apellido' => 'Rakitić',
            'fecha_nacimiento' => '1988-03-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'en-nesyri.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Youssef',
            'apellido' => 'En-Nesyri',
            'fecha_nacimiento' => '1997-06-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'oliviera.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'João',
            'apellido' => 'Oliveira',
            'fecha_nacimiento' => '1997-09-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'remiro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Álex',
            'apellido' => 'Remiro',
            'fecha_nacimiento' => '1994-03-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'zaldúa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Joseba',
            'apellido' => 'Zaldúa',
            'fecha_nacimiento' => '1993-11-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'le-normand.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Aritz',
            'apellido' => 'Elustondo',
            'fecha_nacimiento' => '1994-11-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'sagnan.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Modibo',
            'apellido' => 'Sagnan',
            'fecha_nacimiento' => '1997-12-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'rodrigo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodrigo',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1995-06-06',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'merino.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mikel',
            'apellido' => 'Merino',
            'fecha_nacimiento' => '1996-06-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'silva.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'Silva',
            'fecha_nacimiento' => '1986-01-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'irúa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jon',
            'apellido' => 'Iruábal',
            'fecha_nacimiento' => '1999-05-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'willian-jose.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Willian',
            'apellido' => 'José',
            'fecha_nacimiento' => '1991-11-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'portu.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Portu',
            'fecha_nacimiento' => '1992-10-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'claudio-bravo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Claudio',
            'apellido' => 'Bravo',
            'fecha_nacimiento' => '1983-04-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'bartra.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Marc',
            'apellido' => 'Bartra',
            'fecha_nacimiento' => '1991-01-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mangala.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Eliaquim',
            'apellido' => 'Mangala',
            'fecha_nacimiento' => '1991-02-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'guido.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Guido',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1994-04-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'carvalho.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'William',
            'apellido' => 'Carvalho',
            'fecha_nacimiento' => '1992-04-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'canales.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sergio',
            'apellido' => 'Canales',
            'fecha_nacimiento' => '1991-02-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'fekir.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nabil',
            'apellido' => 'Fekir',
            'fecha_nacimiento' => '1993-07-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'juanmi.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan',
            'apellido' => 'Mi',
            'fecha_nacimiento' => '1993-05-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'borja-iguez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Borja',
            'apellido' => 'Iglesias',
            'fecha_nacimiento' => '1993-01-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'alex-moreno.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Álex',
            'apellido' => 'Moreno',
            'fecha_nacimiento' => '1993-07-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'domenech.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jaume',
            'apellido' => 'Domènech',
            'fecha_nacimiento' => '1990-01-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'gabriel-paus.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gabriel',
            'apellido' => 'Paus',
            'fecha_nacimiento' => '1997-02-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'garay.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ezequiel',
            'apellido' => 'Garay',
            'fecha_nacimiento' => '1986-10-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'albiol.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Raúl',
            'apellido' => 'Albiol',
            'fecha_nacimiento' => '1985-09-04',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'soler.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Soler',
            'fecha_nacimiento' => '1997-01-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'guedes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gonçalo',
            'apellido' => 'Guedes',
            'fecha_nacimiento' => '1996-11-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'parejo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dani',
            'apellido' => 'Parejo',
            'fecha_nacimiento' => '1989-04-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'maxi-gomez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Maxi',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1996-08-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'raphinha.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Raphinha',
            'apellido' => 'Ramos',
            'fecha_nacimiento' => '1997-03-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'gameiro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kevin',
            'apellido' => 'Gameiro',
            'fecha_nacimiento' => '1987-08-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'unai-simon.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Unai',
            'apellido' => 'Simón',
            'fecha_nacimiento' => '1997-06-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Iñigo-Martínez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Iñigo',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1991-05-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'yeray-alvarez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Yeray',
            'apellido' => 'Álvarez',
            'fecha_nacimiento' => '1995-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'andoni-irúábal.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Andoni',
            'apellido' => 'Iruábal',
            'fecha_nacimiento' => '1998-09-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mikel-balenciaga.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mikel',
            'apellido' => 'Balenziaga',
            'fecha_nacimiento' => '1988-02-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'dani-garcia.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dani',
            'apellido' => 'García',
            'fecha_nacimiento' => '1990-02-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'beñat-etcheberria.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Beñat',
            'apellido' => 'Etxeberría',
            'fecha_nacimiento' => '1993-01-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'iñaki-williams.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Iñaki',
            'apellido' => 'Williams',
            'fecha_nacimiento' => '1994-06-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'asier-villalibre.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Asier',
            'apellido' => 'Villalibre',
            'fecha_nacimiento' => '1997-01-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'óscar-de-marcos.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Óscar',
            'apellido' => 'De Marcos',
            'fecha_nacimiento' => '1989-04-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'sergio-ascencio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sergio',
            'apellido' => 'Asenjo',
            'fecha_nacimiento' => '1989-06-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'pau-torres.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pau',
            'apellido' => 'Torres',
            'fecha_nacimiento' => '1997-01-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'albiol.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Raúl',
            'apellido' => 'Albiol',
            'fecha_nacimiento' => '1985-09-04',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'daniel-rasmussen.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Daniel',
            'apellido' => 'Rasmussen',
            'fecha_nacimiento' => '1998-08-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'chukwueze.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Samuel',
            'apellido' => 'Chukwueze',
            'fecha_nacimiento' => '1999-05-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'parejo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dani',
            'apellido' => 'Parejo',
            'fecha_nacimiento' => '1989-04-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'moi-gomez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Moi',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1997-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'gerard-moreno.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gerard',
            'apellido' => 'Moreno',
            'fecha_nacimiento' => '1992-04-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'paco-alcacer.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Paco',
            'apellido' => 'Alcácer',
            'fecha_nacimiento' => '1993-08-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'ruben-pena.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rubén',
            'apellido' => 'Peña',
            'fecha_nacimiento' => '1990-03-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'rubén-blanco.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rubén',
            'apellido' => 'Blanco',
            'fecha_nacimiento' => '1996-01-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'jeison-murillo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jeison',
            'apellido' => 'Murillo',
            'fecha_nacimiento' => '1992-05-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'nesta.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Néstor',
            'apellido' => 'Araujo',
            'fecha_nacimiento' => '1991-08-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'andrea-bueno.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Andrea',
            'apellido' => 'Buena',
            'fecha_nacimiento' => '1998-06-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'manuel-oliver.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Manuel',
            'apellido' => 'Oliveira',
            'fecha_nacimiento' => '1999-03-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'francisco-javier.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Francisco',
            'apellido' => 'Javier',
            'fecha_nacimiento' => '1996-08-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'denis-suarez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Denis',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1994-02-06',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'bamba-dieng.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Bamba',
            'apellido' => 'Dieng',
            'fecha_nacimiento' => '1998-09-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'iglesias-pablo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Iglesias',
            'apellido' => 'Pablo',
            'fecha_nacimiento' => '1996-10-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'gabriel-lahera.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gabriel',
            'apellido' => 'Lahera',
            'fecha_nacimiento' => '1993-02-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');


        //Premier League
        $jugador = User::create([
            'file_uri' => 'Aaron_ramsdale.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Aaron',
            'apellido' => 'Ramsdale',
            'fecha_nacimiento' => '1998-05-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Ben_white.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ben',
            'apellido' => 'White',
            'fecha_nacimiento' => '1997-10-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Gabriel_Magalhães.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gabriel',
            'apellido' => 'Magalhães',
            'fecha_nacimiento' => '1997-12-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'William_saliba.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'William',
            'apellido' => 'Saliba',
            'fecha_nacimiento' => '2001-03-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Oleksandr_zinchenko.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Oleksandr',
            'apellido' => 'Zinchenko',
            'fecha_nacimiento' => '1996-12-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Thomas_parthey.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Thomas',
            'apellido' => 'Partey',
            'fecha_nacimiento' => '1993-06-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Martin_odegaard.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martin',
            'apellido' => 'Ödegaard',
            'fecha_nacimiento' => '1998-12-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Bukayo_saka.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Bukayo',
            'apellido' => 'Saka',
            'fecha_nacimiento' => '2001-09-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Gabriel_martinelli.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gabriel',
            'apellido' => 'Martinelli',
            'fecha_nacimiento' => '2001-06-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Gabriel_jesus.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gabriel',
            'apellido' => 'Jesus',
            'fecha_nacimiento' => '1997-04-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'AlissonBecker.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Alisson',
            'apellido' => 'Becker',
            'fecha_nacimiento' => '1992-10-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Trent_alexander_arnold.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Trent',
            'apellido' => 'Alexander-Arnold',
            'fecha_nacimiento' => '1998-10-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Virgil_van_dijk.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Virgil',
            'apellido' => 'Van Dijk',
            'fecha_nacimiento' => '1991-07-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Joel_matip.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Joel',
            'apellido' => 'Matip',
            'fecha_nacimiento' => '1991-08-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Andy_robertson.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Andrew',
            'apellido' => 'Robertson',
            'fecha_nacimiento' => '1994-03-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FabinhoTavares.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Fabinho',
            'apellido' => 'Tavares',
            'fecha_nacimiento' => '1993-10-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Jordan_henderson.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jordan',
            'apellido' => 'Henderson',
            'fecha_nacimiento' => '1990-06-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Mohamed_salah.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mohamed',
            'apellido' => 'Salah',
            'fecha_nacimiento' => '1992-06-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Luis_diaz.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luis',
            'apellido' => 'Díaz',
            'fecha_nacimiento' => '1997-01-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Darwin_nunez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Darwin',
            'apellido' => 'Núñez',
            'fecha_nacimiento' => '1999-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'EdersonMoraes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ederson',
            'apellido' => 'Moraes',
            'fecha_nacimiento' => '1993-10-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Joao_cancelo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'João',
            'apellido' => 'Cancelo',
            'fecha_nacimiento' => '1994-05-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Ruben_dias.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ruben',
            'apellido' => 'Dias',
            'fecha_nacimiento' => '1997-05-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'John_stones.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'John',
            'apellido' => 'Stones',
            'fecha_nacimiento' => '1994-05-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Aymeric_laporte.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Aymeric',
            'apellido' => 'Laporte',
            'fecha_nacimiento' => '1994-05-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RodriHernández.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodri',
            'apellido' => 'Hernández',
            'fecha_nacimiento' => '1996-06-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Kevin_de_bruyne.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kevin',
            'apellido' => 'De Bruyne',
            'fecha_nacimiento' => '1991-06-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Bernardo_silva.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Bernardo',
            'apellido' => 'Silva',
            'fecha_nacimiento' => '1994-08-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Riyad_mahrez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Riyad',
            'apellido' => 'Mahrez',
            'fecha_nacimiento' => '1991-02-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'erling_haaland.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Erling',
            'apellido' => 'Haaland',
            'fecha_nacimiento' => '2000-07-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'David_de_gea.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'De Gea',
            'fecha_nacimiento' => '1990-11-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Aaron_wan_bissaka.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Aaron',
            'apellido' => 'Wan-Bissaka',
            'fecha_nacimiento' => '1997-11-26',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RaphaëlVarane.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Raphaël',
            'apellido' => 'Varane',
            'fecha_nacimiento' => '1993-04-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LisandroMartinez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lisandro',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1998-01-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LukeShaw.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luke',
            'apellido' => 'Shaw',
            'fecha_nacimiento' => '1995-07-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'PaulScholes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Paul',
            'apellido' => 'Scholes',
            'fecha_nacimiento' => '1974-11-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'Bruno_fernandes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Bruno',
            'apellido' => 'Fernandes',
            'fecha_nacimiento' => '1994-09-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DavidBeckham.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'Beckham',
            'fecha_nacimiento' => '1975-05-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'AntonyMatheus_dos_Santos.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Antony',
            'apellido' => 'Matheus dos Santos',
            'fecha_nacimiento' => '2000-02-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CristianoRonaldo.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Cristiano',
            'apellido' => 'Ronaldo',
            'fecha_nacimiento' => '1985-02-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'martinez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Emiliano',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1992-09-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'cash.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Matty',
            'apellido' => 'Cash',
            'fecha_nacimiento' => '1997-08-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'konza.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ezri',
            'apellido' => 'Konza',
            'fecha_nacimiento' => '1998-10-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mings.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Tyrone',
            'apellido' => 'Mings',
            'fecha_nacimiento' => '1993-03-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'digne.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lucas',
            'apellido' => 'Digne',
            'fecha_nacimiento' => '1993-11-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'luiz.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Douglas',
            'apellido' => 'Luiz',
            'fecha_nacimiento' => '1998-05-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kamara.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Boubacar',
            'apellido' => 'Kamara',
            'fecha_nacimiento' => '2000-11-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'coutinho.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Philippe',
            'apellido' => 'Coutinho',
            'fecha_nacimiento' => '1992-06-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'watkins.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ollie',
            'apellido' => 'Watkins',
            'fecha_nacimiento' => '1995-12-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'ingles.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Danny',
            'apellido' => 'Ings',
            'fecha_nacimiento' => '1992-07-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'lloris.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Hugo',
            'apellido' => 'Lloris',
            'fecha_nacimiento' => '1986-12-26',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'romero.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Cristian',
            'apellido' => 'Romero',
            'fecha_nacimiento' => '1998-04-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'dier.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Eric',
            'apellido' => 'Dier',
            'fecha_nacimiento' => '1994-01-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'davies.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ben',
            'apellido' => 'Davies',
            'fecha_nacimiento' => '1993-04-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'perisic.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ivan',
            'apellido' => 'Perišić',
            'fecha_nacimiento' => '1989-02-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'hoybier.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pierre-Emile',
            'apellido' => 'Højbjerg',
            'fecha_nacimiento' => '1995-08-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'bentancur.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodrigo',
            'apellido' => 'Bentancur',
            'fecha_nacimiento' => '1997-06-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kulusevski.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dejan',
            'apellido' => 'Kulusevski',
            'fecha_nacimiento' => '2000-04-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'son.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Son',
            'apellido' => 'Heung-Min',
            'fecha_nacimiento' => '1992-07-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kane.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Harry',
            'apellido' => 'Kane',
            'fecha_nacimiento' => '1993-07-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'pope.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nick',
            'apellido' => 'Pope',
            'fecha_nacimiento' => '1992-04-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'trippier.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kieran',
            'apellido' => 'Trippier',
            'fecha_nacimiento' => '1990-09-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'schar.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Fabian',
            'apellido' => 'Schär',
            'fecha_nacimiento' => '1991-12-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'burn.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Dan',
            'apellido' => 'Burn',
            'fecha_nacimiento' => '1991-11-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'targett.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Matt',
            'apellido' => 'Targett',
            'fecha_nacimiento' => '1996-01-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'guimaraes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Bruno',
            'apellido' => 'Guimarães',
            'fecha_nacimiento' => '1997-11-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'longstaff.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sean',
            'apellido' => 'Longstaff',
            'fecha_nacimiento' => '1997-10-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'wilson.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Callum',
            'apellido' => 'Wilson',
            'fecha_nacimiento' => '1992-02-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'almiron.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Miguel',
            'apellido' => 'Almirón',
            'fecha_nacimiento' => '1994-02-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'isaac.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Alexander',
            'apellido' => 'Isak',
            'fecha_nacimiento' => '1999-09-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kepa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kepa',
            'apellido' => 'Arrizabalaga',
            'fecha_nacimiento' => '1994-10-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'james.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Reece',
            'apellido' => 'James',
            'fecha_nacimiento' => '1999-12-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'koulibaly.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kalidou',
            'apellido' => 'Koulibaly',
            'fecha_nacimiento' => '1991-06-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'silva.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Thiago',
            'apellido' => 'Silva',
            'fecha_nacimiento' => '1984-09-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'chilwell.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ben',
            'apellido' => 'Chilwell',
            'fecha_nacimiento' => '1996-12-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kovacic.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mateo',
            'apellido' => 'Kovačić',
            'fecha_nacimiento' => '1994-05-06',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mount.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mason',
            'apellido' => 'Mount',
            'fecha_nacimiento' => '1999-01-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'sterling.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Raheem',
            'apellido' => 'Sterling',
            'fecha_nacimiento' => '1994-12-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'havertz.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kai',
            'apellido' => 'Havertz',
            'fecha_nacimiento' => '1999-06-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'aubameyang.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pierre-Emerick',
            'apellido' => 'Aubameyang',
            'fecha_nacimiento' => '1989-06-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'guaita.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Vicente',
            'apellido' => 'Guaita',
            'fecha_nacimiento' => '1987-01-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mitchell.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Tyrick',
            'apellido' => 'Mitchell',
            'fecha_nacimiento' => '1999-09-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'kouyaté.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Cheikhou',
            'apellido' => 'Kouyaté',
            'fecha_nacimiento' => '1989-12-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'guita.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'James',
            'apellido' => 'Guita',
            'fecha_nacimiento' => '1997-12-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'clyne.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nathaniel',
            'apellido' => 'Clyne',
            'fecha_nacimiento' => '1991-04-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'zaha.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Wilfried',
            'apellido' => 'Zaha',
            'fecha_nacimiento' => '1992-11-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'eze.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Eberechi',
            'apellido' => 'Eze',
            'fecha_nacimiento' => '1998-06-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'edouard.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Odsonne',
            'apellido' => 'Edouard',
            'fecha_nacimiento' => '1998-01-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mateta.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jean-Philippe',
            'apellido' => 'Mateta',
            'fecha_nacimiento' => '1997-06-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'edouard.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jordan',
            'apellido' => 'Ayew',
            'fecha_nacimiento' => '1991-09-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'raya.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'Raya',
            'fecha_nacimiento' => '1995-09-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'mepham.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Chris',
            'apellido' => 'Mepham',
            'fecha_nacimiento' => '1997-10-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'jansson.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pontus',
            'apellido' => 'Jansson',
            'fecha_nacimiento' => '1991-02-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'henry.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rico',
            'apellido' => 'Henry',
            'fecha_nacimiento' => '1997-02-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'fosu.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Josh',
            'apellido' => 'Fosu',
            'fecha_nacimiento' => '1997-11-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'jensen.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mikkel',
            'apellido' => 'Jensen',
            'fecha_nacimiento' => '1994-07-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'norgaard.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Christian',
            'apellido' => 'Nørgaard',
            'fecha_nacimiento' => '1993-12-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'toney.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ivan',
            'apellido' => 'Toney',
            'fecha_nacimiento' => '1996-03-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'wissa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Yoane',
            'apellido' => 'Wissa',
            'fecha_nacimiento' => '1996-08-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'schade.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Kevin',
            'apellido' => 'Schade',
            'fecha_nacimiento' => '2001-11-27',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');



        //Campeonato Uruguayo
        $jugador = User::create([
            'file_uri' => 'WashingtonAguerre.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Washington',
            'apellido' => 'Aguerre',
            'fecha_nacimiento' => '1992-03-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LéoCoelho.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Léo',
            'apellido' => 'Coelho',
            'fecha_nacimiento' => '1993-05-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GuzmánRodríguez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Guzmán',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1999-07-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MaximilianoOlivera.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Maximiliano',
            'apellido' => 'Olivera',
            'fecha_nacimiento' => '1992-03-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LeoFernández.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Leo',
            'apellido' => 'Fernández',
            'fecha_nacimiento' => '1998-11-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'PedroMilans.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pedro',
            'apellido' => 'Milans',
            'fecha_nacimiento' => '2002-01-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CamiloMayada.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Camilo',
            'apellido' => 'Mayada',
            'fecha_nacimiento' => '1990-03-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'IgnacioSosa.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ignacio',
            'apellido' => 'Sosa',
            'fecha_nacimiento' => '2002-01-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JavierMéndez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Javier',
            'apellido' => 'Méndez',
            'fecha_nacimiento' => '1993-01-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MaximilianoSilvera.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Maximiliano',
            'apellido' => 'Silvera',
            'fecha_nacimiento' => '1997-09-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'SergioRochet.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sergio',
            'apellido' => 'Rochet',
            'fecha_nacimiento' => '1993-03-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LuisMejia.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luis',
            'apellido' => 'Mejia',
            'fecha_nacimiento' => '1991-03-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'EmilianoMartínez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Emiliano',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1992-02-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MauricioPereira.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mauricio',
            'apellido' => 'Pereira',
            'fecha_nacimiento' => '1990-03-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DiegoPolenta.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Diego',
            'apellido' => 'Polenta',
            'fecha_nacimiento' => '1992-09-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'NicolásRodríguez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nicolás',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1991-06-2',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosAuzqui.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Auzqui',
            'fecha_nacimiento' => '1993-07-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GonzaloFucile.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gonzalo',
            'apellido' => 'Fucile',
            'fecha_nacimiento' => '1987-11-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'NicolasLopez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nicolás',
            'apellido' => 'López',
            'fecha_nacimiento' => '1993-10-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'SantiagoBergessio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Santiago',
            'apellido' => 'Bergessio',
            'fecha_nacimiento' => '1984-06-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GuillermoDeAmoresCerro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Guillermo',
            'apellido' => 'De Amores',
            'fecha_nacimiento' => '1994-01-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'SebastiánFuentes.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Sebastián',
            'apellido' => 'Fuentes',
            'fecha_nacimiento' => '1992-05-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JuanMarrero.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan',
            'apellido' => 'Marrero',
            'fecha_nacimiento' => '1993-04-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosSánchezCerro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1994-11-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LucasLópezCerro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lucas',
            'apellido' => 'López',
            'fecha_nacimiento' => '1991-07-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'EmilianoGonzález.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Emiliano',
            'apellido' => 'González',
            'fecha_nacimiento' => '1992-10-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'NicolásRodríguez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nicolás',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1994-06-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'ManuelGonzálezCerro.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Manuel',
            'apellido' => 'González',
            'fecha_nacimiento' => '1995-12-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'AlvaroFernández.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Álvaro',
            'apellido' => 'Fernández',
            'fecha_nacimiento' => '1996-02-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DiegoSuárez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Diego',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1993-09-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DiegoBorges.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Diego',
            'apellido' => 'Borges',
            'fecha_nacimiento' => '1990-02-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MartínMendez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martín',
            'apellido' => 'Méndez',
            'fecha_nacimiento' => '1993-03-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'SantiagoAmaral.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Santiago',
            'apellido' => 'Amaral',
            'fecha_nacimiento' => '1992-04-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'AlejandroPérez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Alejandro',
            'apellido' => 'Pérez',
            'fecha_nacimiento' => '1990-06-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoaquínMíguez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Joaquín',
            'apellido' => 'Míguez',
            'fecha_nacimiento' => '1991-07-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosSánchezB.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1994-10-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FedericoVarela.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Federico',
            'apellido' => 'Varela',
            'fecha_nacimiento' => '1993-05-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RicardoGonzález.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Ricardo',
            'apellido' => 'González',
            'fecha_nacimiento' => '1994-08-23',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoséLuisGómez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José Luis',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1996-04-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoséAlvarez.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Álvarez',
            'fecha_nacimiento' => '1991-09-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'NicolásDíazProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nicolás',
            'apellido' => 'Díaz',
            'fecha_nacimiento' => '1991-06-24',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'HéctorRodríguezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Héctor',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1990-08-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DiegoReyesProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Diego',
            'apellido' => 'Reyes',
            'fecha_nacimiento' => '1992-03-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JorgeBenítezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Jorge',
            'apellido' => 'Benítez',
            'fecha_nacimiento' => '1993-10-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LuisFernándezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luis',
            'apellido' => 'Fernández',
            'fecha_nacimiento' => '1994-05-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'PabloGonzálezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pablo',
            'apellido' => 'González',
            'fecha_nacimiento' => '1993-01-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosJiménezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Jiménez',
            'fecha_nacimiento' => '1994-12-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoséMartínezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1992-11-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FranciscoLópezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Francisco',
            'apellido' => 'López',
            'fecha_nacimiento' => '1991-02-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JuanPérezProgreso.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan',
            'apellido' => 'Pérez',
            'fecha_nacimiento' => '1990-04-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LuisGonzálezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Luis',
            'apellido' => 'González',
            'fecha_nacimiento' => '1990-01-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FrancoToralDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Franco',
            'apellido' => 'Toral',
            'fecha_nacimiento' => '1992-06-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DavidCáceresDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'David',
            'apellido' => 'Cáceres',
            'fecha_nacimiento' => '1993-05-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'EduardoPereiraDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Eduardo',
            'apellido' => 'Pereira',
            'fecha_nacimiento' => '1991-03-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosRuízDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Ruíz',
            'fecha_nacimiento' => '1994-07-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MiguelÁlvarezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Miguel',
            'apellido' => 'Álvarez',
            'fecha_nacimiento' => '1990-11-03',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JuanJoséSánchezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan José',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1992-04-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MartínGómezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martín',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1994-09-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosSuárezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1995-01-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JavierMartínezDanubio.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Javier',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1993-07-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RenéBaptistaDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'René',
            'apellido' => 'Baptista',
            'fecha_nacimiento' => '1991-02-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GerónimoSuárezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gerónimo',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1992-03-25',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LeonardoÁlvarezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Leonardo',
            'apellido' => 'Álvarez',
            'fecha_nacimiento' => '1991-11-17',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FacundoOlivaDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Facundo',
            'apellido' => 'Oliva',
            'fecha_nacimiento' => '1993-02-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JuanPabloGómezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan Pablo',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1994-06-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'PabloGonzálezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Pablo',
            'apellido' => 'González',
            'fecha_nacimiento' => '1994-09-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoaquínSánchezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Joaquín',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1991-08-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosSerranoDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Serrano',
            'fecha_nacimiento' => '1993-11-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FedericoRamírezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Federico',
            'apellido' => 'Ramírez',
            'fecha_nacimiento' => '1992-04-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JuanMartínezDefensorSporting.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Juan',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1990-07-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoséRodríguezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1991-01-10',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosGonzálezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'González',
            'fecha_nacimiento' => '1993-04-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MartínLópezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martín',
            'apellido' => 'López',
            'fecha_nacimiento' => '1992-11-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FedericoPérezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Federico',
            'apellido' => 'Pérez',
            'fecha_nacimiento' => '1994-03-07',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JavierSánchezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Javier',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1993-02-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MauricioHernándezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Mauricio',
            'apellido' => 'Hernández',
            'fecha_nacimiento' => '1992-07-30',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LucasRamírezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lucas',
            'apellido' => 'Ramírez',
            'fecha_nacimiento' => '1990-11-01',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RodrigoGómezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodrigo',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1992-12-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'AlejandroLópezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Alejandro',
            'apellido' => 'López',
            'fecha_nacimiento' => '1994-01-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosMartínezRiverPlate.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1993-09-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'DamiánGonzálezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Damián',
            'apellido' => 'González',
            'fecha_nacimiento' => '1992-05-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'NicolásRodríguezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Nicolás',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1993-06-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'ÁlvaroSuárezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Álvaro',
            'apellido' => 'Suárez',
            'fecha_nacimiento' => '1991-09-14',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosMéndezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Méndez',
            'fecha_nacimiento' => '1992-08-29',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MartínDíazMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martín',
            'apellido' => 'Díaz',
            'fecha_nacimiento' => '1993-11-02',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FedericoDíazMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Federico',
            'apellido' => 'Díaz',
            'fecha_nacimiento' => '1992-04-13',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoaquínRamírezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Joaquín',
            'apellido' => 'Ramírez',
            'fecha_nacimiento' => '1991-07-19',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'SantiagoHernándezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Santiago',
            'apellido' => 'Hernández',
            'fecha_nacimiento' => '1993-01-08',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GonzaloSosaMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gonzalo',
            'apellido' => 'Sosa',
            'fecha_nacimiento' => '1994-12-20',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'RodrigoLópezMontevideoCityTorque.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Rodrigo',
            'apellido' => 'López',
            'fecha_nacimiento' => '1993-03-15',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GonzaloGutiérrezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gonzalo',
            'apellido' => 'Gutiérrez',
            'fecha_nacimiento' => '1991-03-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'EnzoLópezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Enzo',
            'apellido' => 'López',
            'fecha_nacimiento' => '1993-06-05',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'HéctorRamírezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Héctor',
            'apellido' => 'Ramírez',
            'fecha_nacimiento' => '1992-07-16',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'FedericoGonzálezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Federico',
            'apellido' => 'González',
            'fecha_nacimiento' => '1993-05-09',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JavierPérezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Javier',
            'apellido' => 'Pérez',
            'fecha_nacimiento' => '1993-11-21',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'LucasRodríguezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Lucas',
            'apellido' => 'Rodríguez',
            'fecha_nacimiento' => '1992-09-11',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'MartínDíazWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Martín',
            'apellido' => 'Díaz',
            'fecha_nacimiento' => '1993-08-28',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'GonzaloHernándezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Gonzalo',
            'apellido' => 'Hernández',
            'fecha_nacimiento' => '1992-10-22',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'JoséSánchezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'José',
            'apellido' => 'Sánchez',
            'fecha_nacimiento' => '1992-01-18',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');

        $jugador = User::create([
            'file_uri' => 'CarlosMartínezWanderers.png',
            'documento' => fake()->unique()->randomNumber(8),
            'name' => 'Carlos',
            'apellido' => 'Martínez',
            'fecha_nacimiento' => '1991-02-12',
            'direccion' => fake()->address,
            'telefono' => fake()->numberBetween(11111111, 999999999),
            'email' => fake()->unique()->safeemail(),
            'estado' => 'activo',
            'password' => Hash::make('12345678'),
        ]);
        $jugador->assignRole('Jugador');
        */
    }
}
