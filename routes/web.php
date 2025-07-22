<?php

use App\Http\Controllers\Admin\AsignarPermisoController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Jugador\JugadorController;
use App\Http\Controllers\Jugador\PerfilController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'verified', 'role:Administrador|Usuario'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Rutas de administrador
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.sistema.')->group(function () {
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/permisos', PermisoController::class)->names('permisos');
        Route::get('/rolePermiso/{role}', [AsignarPermisoController::class, 'edit'])->name('rolesPermiso.edit');
        Route::put('/rolePermiso/{role}', [AsignarPermisoController::class, 'update'])->name('rolesPermiso.update');
    });

    //Rutas de usuarios y administrador
    Route::resource('/usuario', UserController::class)->names('usuarios');
    Route::get('/layout/admin/cancha', function(){
        return view('admin.cancha.index');
    })->name('admin.cancha.index');
});

//Rutas de Jugador
Route::middleware(['auth', 'verified', 'role:Jugador'])->prefix('jugadores')->name('jugadores.')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::get('/', [JugadorController::class, 'clasificaciones'])->name('clasificaciones');

    Route::get('/jugadores/partidos', function () {
        return view('/jugadores/partidos');
    })->name('partidos');
});

require __DIR__ . '/auth.php';
