@extends('layouts.participantes')
@section('title', 'Equipos')
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
                                <td class="p-4 text-center">
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded text-xs font-bold">
                                        {{ $jugador->pivot->posicion ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 
                                        bg-gradient-to-br from-purple-500 to-pink-500 
                                        rounded-full text-white font-bold text-lg shadow-lg">
                                        {{ $jugador->pivot->num_camiseta ?? '-' }}
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
                                <td class="p-4 text-center font-medium text-white">{{ $jugador->pj }}</td>
                                <td class="p-4 text-center font-bold text-green-400">{{ $jugador->g }}</td>
                                <td class="p-4 text-center font-bold text-blue-400">{{ $jugador->asi }}</td>
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
        </div>

        <!-- Vista Mobile (tarjetas) -->
        <div class="lg:hidden divide-y divide-gray-700/50">
            @forelse ($equipos as $equipo)
                @foreach ($equipo->usuarios as $jugador)
                    <div class="p-4 hover:bg-purple-600/20 transition-colors">
                        <!-- Header de la tarjeta -->
                        <div class="flex items-center gap-3 mb-3">
                            @if($jugador->file_uri)
                                <img src="{{ asset('img/' . $jugador->file_uri) }}" 
                                     alt="{{ $jugador->name }}"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-purple-500">
                            @else
                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 
                                    flex items-center justify-center text-white font-bold">
                                    {{ substr($jugador->name, 0, 1) }}{{ substr($jugador->apellido, 0, 1) }}
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="font-bold text-white text-lg">
                                    {{ $jugador->name }} {{ $jugador->apellido }}
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-blue-500/20 text-blue-400 rounded text-xs font-bold">
                                        {{ $jugador->pivot->posicion ?? '-' }}
                                    </span>
                                    <span class="inline-flex items-center justify-center w-8 h-8 
                                        bg-gradient-to-br from-purple-500 to-pink-500 
                                        rounded-full text-white font-bold text-sm shadow-lg">
                                        {{ $jugador->pivot->num_camiseta ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Estadísticas en grid -->
                        <div class="grid grid-cols-3 gap-3 text-center">
                            <div class="bg-black/20 rounded-lg p-2">
                                <p class="text-xs text-gray-400 mb-1">PJ</p>
                                <p class="text-lg font-bold text-white">{{ $jugador->pj }}</p>
                            </div>
                            <div class="bg-black/20 rounded-lg p-2">
                                <p class="text-xs text-gray-400 mb-1">Goles</p>
                                <p class="text-lg font-bold text-green-400">{{ $jugador->g }}</p>
                            </div>
                            <div class="bg-black/20 rounded-lg p-2">
                                <p class="text-xs text-gray-400 mb-1">Asist</p>
                                <p class="text-lg font-bold text-blue-400">{{ $jugador->asi }}</p>
                            </div>
                        </div>

                        <!-- Tarjetas -->
                        <div class="flex justify-center gap-4 mt-3">
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-gray-400">T.A:</span>
                                @if($jugador->ta > 0)
                                    <span class="inline-flex items-center justify-center w-7 h-7 
                                        bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-bold">
                                        {{ $jugador->ta }}
                                    </span>
                                @else
                                    <span class="text-white text-sm">0</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-gray-400">T.R:</span>
                                @if($jugador->tr > 0)
                                    <span class="inline-flex items-center justify-center w-7 h-7 
                                        bg-red-500/20 text-red-400 rounded-full text-sm font-bold">
                                        {{ $jugador->tr }}
                                    </span>
                                @else
                                    <span class="text-white text-sm">0</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="px-4 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-4xl">👥</span>
                        <span>No hay jugadores en este equipo</span>
                    </div>
                </div>
            @endforelse
        </div>
    </main>
@endsection