<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $usuarios = User::with('roles')->get();
        return view('admin.usuario.index', compact('usuarios'));
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('admin.usuario.create', compact('roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->all());
        //$user->assignRole($request->input('role'));

        $roleName = $request->input('role');
        if ($roleName) {
            $user->assignRole([$roleName]);
        } else {
            $user->assignRole(['jugador']);
        }

        if ($request->hasFile('file_uri')) {
            $file = $request->file('file_uri');
            $fileName = $user->id . "-" . time() . "." . $file->extension();
            $destinationPath = public_path('img');
            $file->move($destinationPath, $fileName);
            $user->file_uri = $fileName;
            $user->save();
        }
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $usuario): View
    {
        $roles = Role::all();
        return view('admin.usuario.edit', compact('usuario', 'roles'));
    }

    public function update(UserRequest $request, User $usuario): RedirectResponse
    {
        //Tengo que ver que cuando edito un usuario sin foto y le quiero cargar la foto no me deja
        if ($request->hasFile('file_uri')) {
            if ($usuario->file_uri && !empty($usuario->file_uri)) {
                $oldImagePath = public_path('img/' . $usuario->file_uri);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }


            $file = $request->file('file_uri');
            $fileName = $usuario->id . "-" . time() . "." . $file->extension();
            $file->move(public_path('img'), $fileName);

            $usuario->file_uri = $fileName;
            $usuario->save();
        }

        $usuario->update($request->input());

        $roleName = $request->input('role');
        if ($roleName) {
            $usuario->syncRoles([$roleName]);
        }

        return redirect()->route('usuarios.index');
    }

    public function destroy(User $usuario)
    {

        if ($usuario->file_uri) {
            $imagePath = public_path('img/' . $usuario->file_uri);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $usuario->delete();
        return back();
    }
}
