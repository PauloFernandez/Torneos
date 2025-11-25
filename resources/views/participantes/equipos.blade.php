@extends('layouts.participantes')
@section('title', 'Equipos')
@section('content')
    <header class="text-center mb-12 fade-in">
        <h1 class="text-5xl font-black uppercase tracking-wider neon-text-purple">Tabla de Posiciones</h1>
    </header>
    <main class="max-w-5xl mx-auto glassmorphism rounded-xl shadow-lg overflow-hidden fade-in" style="animation-delay: 0.2s;">
        <table class="w-full text-left">
                <!-- Encabezado de la tabla -->
                <thead class="bg-black/30 text-gray-300 uppercase text-sm tracking-wider">
                    <tr>
                        <th class="p-4 text-center">POS</th>
                        <th class="p-4 text-center">Nº Camiseta</th>
                        <th class="p-4">Nombre Jugador</th>
                        <th class="p-4 text-center">PJ</th>
                        <th class="p-4 text-center">G</th>
                        <th class="p-4 text-center">ASI</th>
                        <th class="p-4 text-center">T.A</th>
                        <th class="p-4 text-center">T.R</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse ($equipos as $equipo)
                        @foreach ($equipo->usuarios as $jugador)
                            <tr class="hover:bg-purple-600/20 transition-colors duration-200">
                                <!-- Posición -->
                                <td class="p-4 text-center">
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded text-xs font-bold">
                                        {{ $jugador->pivot->posicion ?? '-' }}
                                    </span>
                                </td>

                                <!-- Número de camiseta -->
                                <td class="p-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 
                                        bg-gradient-to-br from-purple-500 to-pink-500 
                                        rounded-full text-white font-bold text-lg shadow-lg">
                                        {{ $jugador->pivot->num_camiseta ?? '-' }}
                                    </span>
                                </td>

                                <!-- Nombre del jugador -->
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        @if($jugador->file_uri)
                                            <img src="{{ asset('storage/' . $jugador->file_uri) }}" 
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

                                <!-- Partidos Jugados -->
                                <td class="p-4 text-center font-medium text-white">
                                    {{ $jugador->pj }}
                                </td>

                                <!-- Goles -->
                                <td class="p-4 text-center font-bold text-green-400">
                                    {{ $jugador->g }}
                                </td>

                                <!-- Asistencias -->
                                <td class="p-4 text-center font-bold text-blue-400">
                                    {{ $jugador->asi }}
                                </td>

                                <!-- Tarjetas Amarillas -->
                                <td class="p-4 text-center">
                                    @if($jugador->ta > 0)
                                        <span class="inline-flex items-center justify-center w-8 h-8 
                                            bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-bold">
                                            {{ $jugador->ta }}
                                        </span>
                                    @else
                                        <span class="text-white">0</span>
                                    @endif
                                </td>

                                <!-- Tarjetas Rojas -->
                                <td class="p-4 text-center">
                                    @if($jugador->tr > 0)
                                        <span class="inline-flex items-center justify-center w-8 h-8 
                                            bg-red-500/20 text-red-400 rounded-full text-sm font-bold">
                                            {{ $jugador->tr }}
                                        </span>
                                    @else
                                        <span class="text-white">0</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-4xl">👥</span>
                                        <span>No hay jugadores en este equipo</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                </tbody>
            </table>
    </main>
@endsection