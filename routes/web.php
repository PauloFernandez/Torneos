<?php

use App\Http\Controllers\Admin\ArbitroController;
use App\Http\Controllers\Admin\AsignarPermisoController;
use App\Http\Controllers\Admin\CanchaController;
use App\Http\Controllers\Admin\DetallePartidoController;
use App\Http\Controllers\Admin\EquipoController;
use App\Http\Controllers\Admin\EquipoUserController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\PartidoController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TarjetaController;
use App\Http\Controllers\Admin\TorneoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Participante\PerfilController;
use App\Http\Controllers\Participante\ParticipanteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'verified', 'active', 'role:Administrador|Usuario'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //Rutas de administrador
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.sistema.')->group(function () {
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/permisos', PermisoController::class)->names('permisos');
        Route::get('admin/rolePermiso/{role}', [AsignarPermisoController::class, 'edit'])->name('rolesPermiso.edit');
        Route::put('admin/rolePermiso/{role}', [AsignarPermisoController::class, 'update'])->name('rolesPermiso.update');
    });

    //Rutas de usuarios y administrador
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/usuarios', UserController::class)->names('usuarios');
    Route::resource('/noticias', NoticiaController::class)->names('noticias');
    Route::resource('/torneos', TorneoController::class)->names('torneos');
    Route::resource('/arbitros', ArbitroController::class)->names('arbitros')->except('show');
    Route::resource('/canchas', CanchaController::class)->names('canchas')->except('show');
    Route::resource('/equipos', EquipoController::class)->names('equipos')->except('show');
    Route::resource('/tarjetas', TarjetaController::class)->names('tarjetas')->except('show');
    //rutas de partidos
    Route::resource('/partidos', PartidoController::class)->names('partidos')->except('show');
    Route::get('admin/partidos/{partido}/get-details', [PartidoController::class, 'getDetails'])->name('partidos.get-details');
    Route::put('admin/partidos/{partido}/update-results', [PartidoController::class, 'updateResults'])->name('partidos.update-results');

    //Rutas de detalle de partidos
    Route::resource('/detallePartidos', DetallePartidoController::class)->names('detallePartidos')->only(['index', 'edit', 'update', 'show', 'destroy']);
    //Route::get('admin/detallePartidos', [DetallePartidoController::class, 'index'])->name('detallePartidos.index');
    
    //Modulo Jugador
    Route::get('admin/jugadores', [EquipoUserController::class, 'index'])->name('jugadores.index');
    Route::get('admin/jugadores/create', [EquipoUserController::class, 'create'])->name('jugadores.create');
    Route::post('admin/jugadores', [EquipoUserController::class, 'store'])->name('jugadores.store');
    Route::delete('admin/jugadores/{jugador}', [EquipoUserController::class, 'destroy'])->name('jugadores.destroy');
    Route::get('admin/jugadores/{jugador}/edit/{equipo}', [EquipoUserController::class, 'edit'])->name('jugadores.edit');
    Route::put('admin/jugadores/{jugador}', [EquipoUserController::class, 'update'])->name('jugadores.update');
});



//Rutas de Jugador
Route::middleware(['auth', 'verified', 'active', 'role:Jugador'])->prefix('participantes')->name('participantes.')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::get('/clasificaciones', [ParticipanteController::class, 'clasificaciones'])->name('clasificaciones');
});

require __DIR__ . '/auth.php';
