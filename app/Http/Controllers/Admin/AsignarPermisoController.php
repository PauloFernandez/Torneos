<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AsignarPermisoController extends Controller
{
    public function edit(Role $role)
    {
        //Para Asignar permisos a los roles
        $permisos = Permission::all();
        return view('admin.sistema.rolesPermiso', compact('role', 'permisos'));
    }

    public function update(Request $request, Role $role)
    {
        //Para Asignar permisos a los roles
        $role->permissions()->sync($request->permisos);
        return redirect()->route('admin.sistema.roles.index', $role);
    }
}
