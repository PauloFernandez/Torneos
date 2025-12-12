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
       // Permission::create([ 'name' => 'Ver Canchas', 'guard_name' => 'web' ]);
        Permission::create([ 'name' => 'Nueva Cancha', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Cancha', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Eliminar Cancha', 'guard_name' => 'web'])->syncRoles(['Administrador', 'Usuario']);

        //Permission::create([ 'name' => 'Ver Arbitros', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Arbitro', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Arbitro', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Eliminar Arbitro', 'guard_name' => 'web'])->syncRoles(['Administrador', 'Usuario']);

        //Permission::create([ 'name' => 'Ver Tarjetas', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Tarjeta', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Tarjeta', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Eliminar Tarjeta', 'guard_name' => 'web'])->syncRoles(['Administrador', 'Usuario']);

        //Permission::create([ 'name' => 'Ver Torneos', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Torneo', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Torneo', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Eliminar Torneo', 'guard_name' => 'web'])->syncRoles(['Administrador']);

        //Permission::create([ 'name' => 'Ver Equipos', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Equipo', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Equipo', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Eliminar Equipo', 'guard_name' => 'web'])->syncRoles(['Administrador']);

        //Permission::create([ 'name' => 'Ver Jugadores', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Asignar Jugador', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Editar Jugador', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Remover Jugador', 'guard_name' => 'web'])->syncRoles(['Administrador', 'Usuario']);

        //Permission::create([ 'name' => 'Ver Partidos', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Partido', 'guard_name' => 'web' ])->syncRoles(['Administrador', 'Usuario']);
        Permission::create([ 'name' => 'Resultado Partido', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Eliminar Partido', 'guard_name' => 'web'])->syncRoles(['Administrador']);

        Permission::create([ 'name' => 'Cargar DetallePartido', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Editar DetallePartido', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Eliminar DetallePartido', 'guard_name' => 'web'])->syncRoles(['Administrador']);

        //Permission::create([ 'name' => 'Ver Noticias', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nueva Noticia', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Editar Noticia', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Eliminar Noticia', 'guard_name' => 'web'])->syncRoles(['Administrador','Usuario']);

        //Permission::create([ 'name' => 'Ver Usuarios', 'guard_name' => 'web' ])->syncRoles(['Administrador']);
        Permission::create([ 'name' => 'Nuevo Usuario', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Editar Usuario', 'guard_name' => 'web' ])->syncRoles(['Administrador','Usuario']);
        Permission::create([ 'name' => 'Eliminar Usuario', 'guard_name' => 'web'])->syncRoles(['Administrador']);
    }
}
