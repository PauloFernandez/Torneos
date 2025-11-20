<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CanchaRequest;
use App\Models\Cancha;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CanchaController extends Controller
{
    public function index(): View
    {
        $canchas = Cancha::query()->when(request('search'), function ($query) {
            return $query->where('nombre', 'LIKE', '%' . request('search') . '%');
        })->orderBy('nombre')->paginate(5)->withQueryString();

        return view('admin.canchas.index', compact('canchas'));
    }

    public function create(): View
    {
        return view('admin.canchas.create');
    }

    public function store(CanchaRequest $request): RedirectResponse
    {
        Cancha::create($request->all());
        return redirect()->route('canchas.index')->with('success', 'Cancha creada correctamente.');
    }

    public function edit(Cancha $cancha): View
    {
        return view('admin.canchas.edit', compact('cancha'));
    }

    public function update(CanchaRequest $request, Cancha $cancha): RedirectResponse
    {
        $cancha->update($request->all());
        return redirect()->route('canchas.index')->with('success', 'Cancha actualizada correctamente.');
    }

    public function destroy(Cancha $cancha)
    {
        $cancha->delete();
        return back()->with('success', 'Cancha eliminada correctamente.');
    }
}
