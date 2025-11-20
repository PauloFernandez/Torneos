<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permission::query()->when(request('search'), function ($query) {
            return $query->where('name', 'LIKE', '%'. request('search') .'%');
        })->withCount('roles')->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.sistema.permisos.index', compact('permisos'));
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->name]);
        return back();
    }

    public function edit(Permission $permiso)
    {
        return view('admin.sistema.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $permiso->update(['name' => $request->name]);
        return redirect()->route('admin.sistema.permisos.index');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return back();
    }
}
