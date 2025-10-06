<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TarjetaRequest;
use App\Models\Tarjeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TarjetaController extends Controller
{

    public function index(): View
    {
        $tarjetas = Tarjeta::all();
        return view('admin.tarjetas.index', compact('tarjetas'));
    }

    public function create(): View
    {
        return view('admin.tarjetas.create');
    }

    public function store(TarjetaRequest $request): RedirectResponse
    {
        Tarjeta::create($request->all());
        return redirect()->route('tarjetas.index')->with('success', 'Tarjeta creada exitosamente.');
    }

    public function edit(Tarjeta $tarjeta): View
    {
        return view('admin.tarjetas.edit', compact('tarjeta'));
    }

    public function update(TarjetaRequest $request, Tarjeta $tarjeta): RedirectResponse
    {
        $tarjeta->update($request->all());
        return redirect()->route('tarjetas.index')->with('success', 'Tarjeta actualizada exitosamente.');
    }

    public function destroy(Tarjeta $tarjeta)
    {
        $tarjeta->delete();
        return back()->with('success', 'Tarjeta eliminada exitosamente.');
    }
}
