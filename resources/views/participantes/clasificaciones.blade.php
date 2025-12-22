@extends('layouts.participantes')
@section('title', 'Clasificaciones')
@section('content')
    <header class="text-center mb-8 md:mb-12 fade-in">
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-wider neon-text-purple">Tabla de Posiciones</h1>
    </header>

    <main class="max-w-5xl mx-auto glassmorphism rounded-xl shadow-lg overflow-hidden fade-in" style="animation-delay: 0.2s;">
        
        <!-- Vista Desktop (tabla) -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-black/30 text-gray-300 uppercase text-sm tracking-wider">
                    <tr>
                        <th class="p-4">Pos</th>
                        <th class="p-4">Equipo</th>
                        <th class="p-4 text-center">PJ</th>
                        <th class="p-4 text-center">G</th>
                        <th class="p-4 text-center">E</th>
                        <th class="p-4 text-center">P</th>
                        <th class="p-4 text-center">SG</th>
                        <th class="p-4 text-center font-bold">Pts</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse ($torneos as $torneo)
                        @foreach ($torneo->equipos as $index => $equipo)
                            <tr class="hover:bg-purple-600/20 transition-colors duration-200">
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
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('img/' . $equipo->file_uri) }}" 
                                             alt="Logo {{ $equipo->nombre }}" 
                                             class="h-8 w-8 object-contain">
                                        <span class="font-semibold text-white">{{ $equipo->nombre }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-center text-white">{{ $equipo->PJ }}</td>
                                <td class="p-4 text-center text-green-400 font-semibold">{{ $equipo->G }}</td>
                                <td class="p-4 text-center text-yellow-400 font-semibold">{{ $equipo->E }}</td>
                                <td class="p-4 text-center text-red-400 font-semibold">{{ $equipo->P }}</td>
                                <td class="p-4 text-center text-white">{{ $equipo->DG }}</td>
                                <td class="p-4 text-center font-bold text-xl text-purple-400">{{ $equipo->Pts }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="text-4xl">🏆</span>
                                    <span>No se encontraron datos</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Vista Mobile y Tablet (tarjetas) -->
        <div class="lg:hidden divide-y divide-gray-700/50">
            @forelse ($torneos as $torneo)
                @foreach ($torneo->equipos as $index => $equipo)
                    <div class="p-4 hover:bg-purple-600/20 transition-colors">
                        <!-- Header de la tarjeta con posición y equipo -->
                        <div class="flex items-center gap-3 mb-4">
                            <!-- Posición -->
                            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full 
                                {{ $index == 0 ? 'bg-yellow-500/20' : ($index == 1 ? 'bg-gray-500/20' : ($index == 2 ? 'bg-orange-500/20' : 'bg-purple-500/20')) }}">
                                <span class="text-2xl font-bold">
                                    @if($index == 0)
                                        🥇
                                    @elseif($index == 1)
                                        🥈
                                    @elseif($index == 2)
                                        🥉
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </span>
                            </div>
                            
                            <!-- Logo y nombre del equipo -->
                            <div class="flex items-center gap-2 flex-1">
                                <img src="{{ asset('img/' . $equipo->file_uri) }}" 
                                     alt="Logo {{ $equipo->nombre }}" 
                                     class="h-10 w-10 object-contain">
                                <div>
                                    <p class="font-bold text-white text-lg">{{ $equipo->nombre }}</p>
                                    <p class="text-sm text-purple-400 font-bold">{{ $equipo->Pts }} puntos</p>
                                </div>
                            </div>
                        </div>

                        <!-- Grid de estadísticas principales -->
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            <div class="bg-black/30 rounded-lg p-2 text-center">
                                <p class="text-xs text-gray-400 mb-1">PJ</p>
                                <p class="text-lg font-bold text-white">{{ $equipo->PJ }}</p>
                            </div>
                            <div class="bg-black/30 rounded-lg p-2 text-center">
                                <p class="text-xs text-gray-400 mb-1">G</p>
                                <p class="text-lg font-bold text-green-400">{{ $equipo->G }}</p>
                            </div>
                            <div class="bg-black/30 rounded-lg p-2 text-center">
                                <p class="text-xs text-gray-400 mb-1">E</p>
                                <p class="text-lg font-bold text-yellow-400">{{ $equipo->E }}</p>
                            </div>
                            <div class="bg-black/30 rounded-lg p-2 text-center">
                                <p class="text-xs text-gray-400 mb-1">P</p>
                                <p class="text-lg font-bold text-red-400">{{ $equipo->P }}</p>
                            </div>
                        </div>

                        <!-- Diferencia de goles -->
                        <div class="flex justify-center">
                            <div class="inline-flex items-center gap-2 bg-black/30 rounded-full px-4 py-1.5">
                                <span class="text-xs text-gray-400">Dif. Goles:</span>
                                <span class="font-bold text-white text-sm">
                                    {{ $equipo->DG > 0 ? '+' : '' }}{{ $equipo->DG }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="px-4 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-4xl">🏆</span>
                        <span>No se encontraron datos</span>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Leyenda móvil -->
    <div class="lg:hidden max-w-5xl mx-auto mt-4 px-4 fade-in" style="animation-delay: 0.4s;">
        <div class="glassmorphism rounded-lg p-4">
            <p class="text-xs text-gray-400 font-semibold mb-2">LEYENDA:</p>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div><span class="text-gray-300 font-bold">PJ:</span> <span class="text-gray-400">Partidos Jugados</span></div>
                <div><span class="text-green-400 font-bold">G:</span> <span class="text-gray-400">Ganados</span></div>
                <div><span class="text-yellow-400 font-bold">E:</span> <span class="text-gray-400">Empatados</span></div>
                <div><span class="text-red-400 font-bold">P:</span> <span class="text-gray-400">Perdidos</span></div>
                <div><span class="text-gray-300 font-bold">SG:</span> <span class="text-gray-400">Diferencia de Goles</span></div>
                <div><span class="text-purple-400 font-bold">Pts:</span> <span class="text-gray-400">Puntos</span></div>
            </div>
        </div>
    </div>
@endsection