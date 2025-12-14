<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArbitrosRequest;
use App\Models\Arbitro;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArbitroController extends Controller
{
    public function index(): View
    {
        $arbitros = Arbitro::query()->when(request('search'), function ($query) {
            return $query->where('documento', 'LIKE', '%' . request('search') . '%')
                ->orWhere('nombre', 'LIKE', '%' . request('search') . '%')
                ->orWhere('apellido', 'LIKE', '%' . request('search') . '%');
        })->orderBy('nombre')->paginate(5)->withQueryString();

        return view('admin.arbitros.index', compact('arbitros'));
    }

    public function create(): View
    {
        return view('admin.arbitros.create');
    }

    public function store(ArbitrosRequest $request): RedirectResponse
    {

        Arbitro::create($request->all());
        return redirect()->route('arbitros.index')->with('success', 'Arbitro registrado exitosamente.');
    }

    public function edit(Arbitro $arbitro): View
    {
        return view('admin.arbitros.edit', compact('arbitro'));
    }

    public function update(ArbitrosRequest $request, Arbitro $arbitro): RedirectResponse
    {
        $arbitro->update($request->all());
        return redirect()->route('arbitros.index')->with('success', 'Arbitro actualizado exitosamente.');
    }

    public function destroy(Arbitro $arbitro)
    {
        $arbitro->delete();
        return back()->with('danger', 'Arbitro eliminado exitosamente.');
    }
}
