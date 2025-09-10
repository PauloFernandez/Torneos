<?php

namespace App\Http\Controllers\Participante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function clasificaciones()
    {
        return view('participantes.clasificaciones');
    }
}
