<?php

use App\Http\Controllers\Admin\ArbitroController;
use App\Http\Controllers\Admin\AsignarPermisoController;
use App\Http\Controllers\Admin\CanchaController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TorneoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Jugador\JugadorController;
use App\Http\Controllers\Jugador\PerfilController;
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
});


//Rutas de Jugador
Route::middleware(['auth', 'verified', 'active', 'role:Jugador'])->prefix('jugadores')->name('jugadores.')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::get('/', [JugadorController::class, 'clasificaciones'])->name('clasificaciones');

    Route::get('/jugadores/partidos', function () {
        return view('/jugadores/partidos');
    })->name('partidos');
});

require __DIR__ . '/auth.php';
