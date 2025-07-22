<?php

namespace App\Http\Controllers\Jugador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function clasificaciones()
    {
        return view('jugadores.clasificaciones');
    }
}
