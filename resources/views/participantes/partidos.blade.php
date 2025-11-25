@extends('layouts.participantes')
@section('title', 'Mis Partidos')

@section('content')
<header class="text-center mb-12 fade-in">
    <h1 class="text-5xl font-black uppercase tracking-wider neon-text-purple">Mis Partidos</h1>
    <p class="text-gray-400 mt-2">Consulta el calendario de tus encuentros</p>
</header>

<main class="max-w-7xl mx-auto space-y-8">
    @forelse ($torneos as $torneo)
        <section class="glassmorphism rounded-xl shadow-lg overflow-hidden fade-in">
            <!-- Encabezado del torneo -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4">
                <h2 class="text-2xl font-bold text-white">
                    🏆 {{ $torneo->nombre }}
                </h2>
            </div>

            <!-- Tabla de partidos -->
            <div class="overflow-x-auto">
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
                                
                                <!-- Fecha -->
                                <td class="p-3 text-center text-sm">
                                    {{ $partido->fecha->format('d/m/Y') }}
                                </td>

                                <!-- Hora -->
                                <td class="p-3 text-center text-sm font-medium">
                                    {{ $partido->hora }}
                                </td>

                                <!-- Cancha -->
                                <td class="p-3 text-center text-sm text-gray-400">
                                    {{ $partido->cancha->nombre }}
                                </td>

                                <!-- Arbitro -->
                                <td class="p-3 text-center text-sm text-gray-400">
                                    {{ $partido->arbitro->nombre }}
                                </td>

                                <!-- Equipo Local -->
                                <td class="p-3 text-right font-semibold">
                                    <span class="inline-flex items-center gap-2">
                                        {{ $partido->equipoLocal->nombre }}
                                        @if($partido->ganador_id === $partido->equipo_local_id)
                                            <span class="text-green-400">🏆</span>
                                        @endif
                                    </span>
                                </td>

                                <!-- Resultado -->
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

                                <!-- Equipo Visitante -->
                                <td class="p-3 text-left font-semibold">
                                    <span class="inline-flex items-center gap-2">
                                        @if($partido->ganador_id === $partido->equipo_visitante_id)
                                            <span class="text-green-400">🏆</span>
                                        @endif
                                        {{ $partido->equipoVisitante->nombre }}
                                    </span>
                                </td>

                                <!-- Estado -->
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
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
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
        </section>
    @empty
        <div class="glassmorphism rounded-xl p-12 text-center">
            <span class="text-6xl mb-4 block">🏆</span>
            <h3 class="text-2xl font-bold text-gray-300 mb-2">No participas en ningún torneo</h3>
            <p class="text-gray-500">Contacta con tu administrador para ser agregado a un equipo</p>
        </div>
    @endforelse
</main>
@endsection