@extends('layouts.participantes')
@section('title', 'Mis Partidos')

@section('content')
    <header class="text-center mb-8 md:mb-12 fade-in">
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-wider neon-text-purple">Mis Partidos</h1>
        <p class="text-black mt-2 text-sm md:text-base">Consulta el calendario de tus encuentros</p>
    </header>

    <main class="max-w-7xl mx-auto space-y-8">
        @forelse ($torneos as $torneo)
            <section class="glassmorphism rounded-xl shadow-lg overflow-hidden fade-in">
                <!-- Encabezado del torneo -->
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-3 md:p-4">
                    <h2 class="text-xl md:text-2xl font-bold text-white">
                        🏆 {{ $torneo->nombre }}
                    </h2>
                </div>

                <!-- Vista Desktop (tabla) -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-black/30 text-gray-300 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="p-3 text-center">Fecha</th>
                                <th class="p-3 text-center">Hora</th>
                                <th class="p-3 text-center">Cancha</th>
                                <th class="p-3 text-center">Arbitro</th>
                                <th class="p-3 text-right">Local</th>
                                <th class="p-3 text-center w-24">Resultado</th>
                                <th class="p-3 text-left">Visitante</th>
                                <th class="p-3 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            @forelse ($torneo->partidos as $partido)
                                <tr class="hover:bg-purple-600/20 transition-colors duration-200
                                    {{ $partido->estado === 'finalizado' ? 'opacity-60' : '' }}">
                                    
                                    <td class="p-3 text-center text-sm">
                                        {{ $partido->fecha->format('d/m/Y') }}
                                    </td>

                                    <td class="p-3 text-center text-sm font-medium">
                                        {{ $partido->hora }}
                                    </td>

                                    <td class="p-3 text-center text-sm text-gray-400">
                                        {{ $partido->cancha->nombre }}
                                    </td>

                                    <td class="p-3 text-center text-sm text-gray-400">
                                        {{ $partido->arbitro->nombre }}
                                    </td>

                                    <td class="p-3 text-right font-semibold text-white">
                                        <span class="inline-flex items-center gap-2">
                                            {{ $partido->equipoLocal->nombre }}
                                            @if($partido->ganador_id === $partido->equipo_local_id)
                                                <span class="text-green-400">🏆</span>
                                            @endif
                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        @if ($partido->estado === 'finalizado')
                                            <div class="flex items-center justify-center gap-2">
                                                <span class="text-2xl font-bold 
                                                    {{ $partido->goles_local > $partido->goles_visitante ? 'text-green-400' : 'text-gray-400' }}">
                                                    {{ $partido->goles_local }}
                                                </span>
                                                <span class="text-gray-500 font-bold">-</span>
                                                <span class="text-2xl font-bold 
                                                    {{ $partido->goles_visitante > $partido->goles_local ? 'text-green-400' : 'text-gray-400' }}">
                                                    {{ $partido->goles_visitante }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic text-sm">vs</span>
                                        @endif
                                    </td>

                                    <td class="p-3 text-left font-semibold text-white">
                                        <span class="inline-flex items-center gap-2">
                                            @if($partido->ganador_id === $partido->equipo_visitante_id)
                                                <span class="text-green-400">🏆</span>
                                            @endif
                                            {{ $partido->equipoVisitante->nombre }}
                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        @php
                                            $estados = [
                                                'programado' => ['bg-blue-500/20', 'text-blue-400', '📅'],
                                                'en_curso' => ['bg-green-500/20', 'text-green-400', '▶️'],
                                                'finalizado' => ['bg-gray-500/20', 'text-gray-400', '✓'],
                                                'cancelado' => ['bg-red-500/20', 'text-red-400', '✗'],
                                            ];
                                            [$bg, $text, $icon] = $estados[$partido->estado] ?? ['bg-gray-500/20', 'text-gray-400', '?'];
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium {{ $bg }} {{ $text }}">
                                            <span>{{ $icon }}</span>
                                            {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="text-4xl">📅</span>
                                            <span>No hay partidos programados</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Vista Mobile y Tablet (tarjetas) -->
                <div class="lg:hidden divide-y divide-gray-700/50">
                    @forelse ($torneo->partidos as $partido)
                        @php
                            $estados = [
                                'programado' => ['bg-blue-500/20', 'text-blue-400', '📅'],
                                'en_curso' => ['bg-green-500/20', 'text-green-400', '▶️'],
                                'finalizado' => ['bg-gray-500/20', 'text-gray-400', '✓'],
                                'cancelado' => ['bg-red-500/20', 'text-red-400', '✗'],
                            ];
                            [$bg, $text, $icon] = $estados[$partido->estado] ?? ['bg-gray-500/20', 'text-gray-400', '?'];
                        @endphp
                        
                        <div class="p-4 hover:bg-purple-600/20 transition-colors
                            {{ $partido->estado === 'finalizado' ? 'opacity-70' : '' }}">
                            
                            <!-- Fecha, hora y estado -->
                            <div class="flex justify-between items-center mb-3">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="text-gray-300 font-semibold">📆 {{ $partido->fecha->format('d/m/Y') }}</span>
                                    <span class="text-gray-500">•</span>
                                    <span class="text-purple-400 font-bold">{{ $partido->hora }}</span>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $bg }} {{ $text }}">
                                    {{ $icon }} {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
                                </span>
                            </div>

                            <!-- Enfrentamiento -->
                            <div class="bg-black/20 rounded-lg p-4 mb-3">
                                <!-- Equipo Local -->
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2 flex-1">
                                        <span class="text-white font-bold text-lg">{{ $partido->equipoLocal->nombre }}</span>
                                        @if($partido->ganador_id === $partido->equipo_local_id)
                                            <span class="text-green-400 text-xl">🏆</span>
                                        @endif
                                    </div>
                                    @if($partido->estado === 'finalizado')
                                        <span class="text-3xl font-black 
                                            {{ $partido->goles_local > $partido->goles_visitante ? 'text-green-400' : 'text-gray-400' }}">
                                            {{ $partido->goles_local }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Separador VS -->
                                <div class="flex items-center justify-center py-2">
                                    @if($partido->estado === 'finalizado')
                                        <span class="text-gray-500 font-bold text-sm">━━━━━</span>
                                    @else
                                        <span class="px-3 py-1 bg-purple-600/30 rounded-full text-sm font-bold text-purple-300">VS</span>
                                    @endif
                                </div>

                                <!-- Equipo Visitante -->
                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center gap-2 flex-1">
                                        @if($partido->ganador_id === $partido->equipo_visitante_id)
                                            <span class="text-green-400 text-xl">🏆</span>
                                        @endif
                                        <span class="text-white font-bold text-lg">{{ $partido->equipoVisitante->nombre }}</span>
                                    </div>
                                    @if($partido->estado === 'finalizado')
                                        <span class="text-3xl font-black 
                                            {{ $partido->goles_visitante > $partido->goles_local ? 'text-green-400' : 'text-gray-400' }}">
                                            {{ $partido->goles_visitante }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Información adicional -->
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="bg-black/20 rounded-lg px-3 py-2">
                                    <p class="text-gray-400 mb-0.5">Cancha</p>
                                    <p class="text-white font-semibold">{{ $partido->cancha->nombre }}</p>
                                </div>
                                <div class="bg-black/20 rounded-lg px-3 py-2">
                                    <p class="text-gray-400 mb-0.5">Árbitro</p>
                                    <p class="text-white font-semibold">{{ $partido->arbitro->nombre }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">📅</span>
                                <span>No hay partidos programados</span>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        @empty
            <div class="glassmorphism rounded-xl p-8 md:p-12 text-center">
                <span class="text-5xl md:text-6xl mb-4 block">🏆</span>
                <h3 class="text-xl md:text-2xl font-bold text-gray-300 mb-2">No participas en ningún torneo</h3>
                <p class="text-gray-500 text-sm md:text-base">Contacta con tu administrador para ser agregado a un equipo</p>
            </div>
        @endforelse
    </main>
@endsection