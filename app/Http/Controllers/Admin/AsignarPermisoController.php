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
        $permisos = Permission::query()->when(request('search'), function($query){
            return $query->where('name', 'LIKE', '%'. request('search') .'%');
        })->paginate(15)->appends(request()->query());

        return view('admin.sistema.rolesPermiso', compact('role', 'permisos'));
    }

    public function update(Request $request, Role $role)
    {
        //Para Asignar permisos a los roles
        $role->permissions()->sync($request->permisos);
        return redirect()->route('admin.sistema.roles.index', $role);
    }
}
