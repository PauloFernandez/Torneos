@extends('layouts.participantes')
@section('title', 'Goleadores')
@section('content')
    <header class="text-center mb-12 fade-in">
        <h1 class="text-5xl font-black uppercase tracking-wider neon-text-purple">Tabla de Goleadores</h1>
    </header>
    <main class="max-w-5xl mx-auto glassmorphism rounded-xl shadow-lg overflow-hidden fade-in fade-transition" style="animation-delay: 0.2s;">
        <table class="w-full text-left">
            <thead class="bg-black/30 text-gray-300 uppercase text-sm tracking-wider">
                <tr>
                    <th class="p-4">Pos</th>
                    <th class="p-4">Equipo</th>
                    <th class="p-4">Jugador</th>
                    <th class="p-4 text-center font-bold">Goles</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/50">
                @forelse ($jugadoresOrdenados as $index => $jugador)
                    <tr class="hover:bg-purple-600/30 transition-colors duration-200">
                        <td class="p-4 font-bold text-xl">
                            @if($index == 0)
                                <span class="text-yellow-400">🥇</span>
                            @elseif($index == 1)
                                <span class="text-gray-300">🥈</span>
                            @elseif($index == 2)
                                <span class="text-orange-400">🥉</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 bg-purple-600/30 rounded-full text-sm">
                                {{ $jugador->equipo_nombre }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                @if($jugador->file_uri)
                                    <img src="{{ asset('img/' . $jugador->file_uri) }}" 
                                         alt="{{ $jugador->name }}"
                                         class="w-10 h-10 rounded-full object-cover border-2 border-purple-500">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 
                                        flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($jugador->name, 0, 1) }}{{ substr($jugador->apellido, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-white">
                                        {{ $jugador->name }} {{ $jugador->apellido }} 
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center font-bold text-2xl text-white">
                            <span class="bg-gradient-to-r from-purple-500 to-pink-500 bg-clip-text text-transparent">
                                {{ $jugador->g }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span>No hay datos registrados</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
@endsection