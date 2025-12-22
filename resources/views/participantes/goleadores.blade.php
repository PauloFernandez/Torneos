@extends('layouts.participantes')
@section('title', 'Goleadores')
@section('content')
    <header class="text-center mb-8 md:mb-12 fade-in">
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-wider neon-text-purple">Tabla de Goleadores</h1>
        <p class="text-gray-400 mt-2 text-sm md:text-base">⚽ Los máximos artilleros del torneo</p>
    </header>

    <main class="max-w-5xl mx-auto glassmorphism rounded-xl shadow-lg overflow-hidden fade-in" style="animation-delay: 0.2s;">
        
        <!-- Vista Desktop (tabla) -->
        <div class="hidden lg:block overflow-x-auto">
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
                                <span class="px-3 py-1 bg-purple-600/30 rounded-full text-sm text-gray-200">
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
                            <td class="p-4 text-center font-bold text-2xl">
                                <span class="bg-gradient-to-r from-purple-500 to-pink-500 bg-clip-text text-transparent">
                                    {{ $jugador->g }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="text-4xl">⚽</span>
                                    <span>No hay datos registrados</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Vista Mobile y Tablet (tarjetas) -->
        <div class="lg:hidden divide-y divide-gray-700/50">
            @forelse ($jugadoresOrdenados as $index => $jugador)
                <div class="p-4 hover:bg-purple-600/20 transition-colors">
                    <div class="flex items-center gap-4">
                        <!-- Posición con medalla -->
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
                                    <span class="text-white text-lg">{{ $index + 1 }}</span>
                                @endif
                            </span>
                        </div>

                        <!-- Foto y datos del jugador -->
                        <div class="flex-1 flex items-center gap-3">
                            @if($jugador->file_uri)
                                <img src="{{ asset('img/' . $jugador->file_uri) }}" 
                                     alt="{{ $jugador->name }}"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-purple-500 shadow-lg">
                            @else
                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 
                                    flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($jugador->name, 0, 1) }}{{ substr($jugador->apellido, 0, 1) }}
                                </div>
                            @endif
                            
                            <div class="flex-1">
                                <p class="font-bold text-white text-lg leading-tight">
                                    {{ $jugador->name }} {{ $jugador->apellido }}
                                </p>
                                <span class="inline-block mt-1 px-2 py-0.5 bg-purple-600/30 rounded-full text-xs text-gray-200">
                                    {{ $jugador->equipo_nombre }}
                                </span>
                            </div>
                        </div>

                        <!-- Cantidad de goles (destacado) -->
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 
                                    flex items-center justify-center shadow-lg border-2 border-purple-400/50">
                                    <div class="text-center">
                                        <p class="text-2xl font-black text-white leading-none">{{ $jugador->g }}</p>
                                        <p class="text-[8px] text-purple-200 uppercase font-bold">goles</p>
                                    </div>
                                </div>
                                <!-- Efecto de brillo -->
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-4xl">⚽</span>
                        <span>No hay datos registrados</span>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Podio visual para móviles (Top 3) -->
    @if(count($jugadoresOrdenados) >= 3)
        <div class="lg:hidden max-w-5xl mx-auto mt-6 px-4 fade-in" style="animation-delay: 0.4s;">
            <div class="glassmorphism rounded-xl p-4">
                <h3 class="text-center text-sm font-bold text-gray-300 mb-4 uppercase tracking-wider">
                    🏆 Podio de Goleadores
                </h3>
                <div class="flex items-end justify-center gap-2">
                    <!-- 2do Lugar -->
                    <div class="flex-1 text-center">
                        <div class="bg-gray-500/20 rounded-t-lg p-3 h-20 flex flex-col justify-end">
                            <p class="text-3xl mb-1">🥈</p>
                            <p class="text-xs text-gray-300 font-bold">{{ $jugadoresOrdenados[1]->g }} goles</p>
                        </div>
                        <div class="bg-gray-600/30 py-2 rounded-b-lg">
                            <p class="text-xs text-white font-semibold truncate px-1">
                                {{ explode(' ', $jugadoresOrdenados[1]->name)[0] }}
                            </p>
                        </div>
                    </div>

                    <!-- 1er Lugar -->
                    <div class="flex-1 text-center">
                        <div class="bg-yellow-500/20 rounded-t-lg p-3 h-28 flex flex-col justify-end border-2 border-yellow-500/50">
                            <p class="text-4xl mb-1">🥇</p>
                            <p class="text-sm text-yellow-400 font-black">{{ $jugadoresOrdenados[0]->g }} goles</p>
                        </div>
                        <div class="bg-yellow-600/30 py-2 rounded-b-lg">
                            <p class="text-xs text-white font-bold truncate px-1">
                                {{ explode(' ', $jugadoresOrdenados[0]->name)[0] }}
                            </p>
                        </div>
                    </div>

                    <!-- 3er Lugar -->
                    <div class="flex-1 text-center">
                        <div class="bg-orange-500/20 rounded-t-lg p-3 h-16 flex flex-col justify-end">
                            <p class="text-2xl mb-1">🥉</p>
                            <p class="text-xs text-orange-300 font-bold">{{ $jugadoresOrdenados[2]->g }} goles</p>
                        </div>
                        <div class="bg-orange-600/30 py-2 rounded-b-lg">
                            <p class="text-xs text-white font-semibold truncate px-1">
                                {{ explode(' ', $jugadoresOrdenados[2]->name)[0] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection