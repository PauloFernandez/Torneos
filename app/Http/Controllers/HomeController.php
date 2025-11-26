<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $torneos = Torneo::withCount('equipos')
                    ->where('estado', 1)
                    ->get();
        return view('home', compact('torneos'));
    }
}
