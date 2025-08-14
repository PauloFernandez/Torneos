<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Services\GestionImagService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(protected GestionImagService $gestionImag)
    {
        
    }

    public function index(): View
    {
        $usuarios = User::with('roles')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function edit(User $usuario): View
    {
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function show(User $usuario): View
    {
        $roles = Role::all();
        return view('admin.usuarios.show', compact('usuario', 'roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->all());

        $roleName = $request->input('role');
        if ($roleName) {
            $user->assignRole([$roleName]);
        } else {
            $user->assignRole(['jugador']);
        }

        $this->gestionImag->storage($request, $user); //llama al servicio para gestionar la carga de la foto

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function update(UserRequest $request, User $usuario): RedirectResponse
    {
        $this->gestionImag->update($request, $usuario); //llama al servicio para gestionar la actualizacion de la foto

        $usuario->update($request->input());

        $roleName = $request->input('role');
        if ($roleName) {
            $usuario->syncRoles([$roleName]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy(User $usuario)
    {
        $this->gestionImag->delete($usuario); //llama al servicio para gestionar la eliminacion de la foto
        $usuario->delete();
        return back()->with('danger', 'Usuario eliminado exitosamente');
    }
}
