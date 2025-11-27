<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoticiaRequest;
use App\Models\Noticia;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoticiaController extends Controller
{
    public function index(): View
    {
        $noticias = Noticia::query()
            ->with('user')
            ->when(request('search'), function ($query) {
                return $query->where('titulo', 'LIKE', '%' . request('search') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'LIKE', '%' . request('search') . '%');
                    });
            })
            ->orderBy('fecha_publicado', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.noticias.index', compact('noticias'));
    }

    public function create(): View
    {
        return view('admin.noticias.create');
    }

    public function store(NoticiaRequest $request): RedirectResponse
    {
        Noticia::create($request->all());
        return redirect()->route('noticias.index')->with('success', 'Noticia creada correctamente');
    }

    public function edit(Noticia $noticia): View
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(NoticiaRequest $request, Noticia $noticia): RedirectResponse
    {
        $noticia->update($request->all());
        return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return back()->with('danger', 'Noticia eliminada correctamente');
    }
}
