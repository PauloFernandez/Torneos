<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Partido
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">   
            {{-- Información del Partido --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ $detallePartido->torneo->nombre }}
                    </h3>
                    <h6 class="text-2xl text-gray-800">
                        {{ $detallePartido->fecha->format('d/m/Y')}} - {{ $detallePartido->hora }} 
                    </h6>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">         
                {{-- Columna Equipo Local --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-blue-500">
                        <h3 class="text-xl font-bold text-gray-800">
                            🏠 {{ $detallePartido->equipoLocal->nombre }}
                        </h3>
                        <span class="text-3xl font-bold text-blue-600">
                            {{ $detallePartido->goles_local }}
                        </span>
                    </div>   
                    @forelse($detallePartido->detalles->where('equipo_id', $detallePartido->equipo_local_id) as $detalle)
                        @php
                            // Buscar el equipo específico en la colección de equipos del jugador
                            $equipoJugador = $detalle->jugador->equipos->find($detalle->equipo_id);
                        @endphp
                        
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-3">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-xs">
                                        ✓
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $detalle->jugador->name }} {{ $detalle->jugador->apellido }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ $equipoJugador->pivot->posicion ?? 'N/A' }} - 
                                            #{{ $equipoJugador->pivot->num_camiseta ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $detalle->tipo_participacion === 'titular' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($detalle->tipo_participacion) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-3 border-t border-gray-300">
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">⚽ Goles</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $detalle->goles }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🎯 Asistencias</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $detalle->asistencias }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🟨 Amarillas</p>
                                    <p class="text-xl font-bold text-yellow-600">{{ $detalle->tarjetas_amarillas }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🟥 Rojas</p>
                                    <p class="text-xl font-bold text-red-600">{{ $detalle->tarjetas_rojas }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">
                            No hay jugadores registrados en este partido
                        </p>
                    @endforelse
                </div>
                {{-- Columna Equipo Visitante --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-red-500">
                        <h3 class="text-xl font-bold text-gray-800">
                            ✈️ {{ $detallePartido->equipoVisitante->nombre }}
                        </h3>
                        <span class="text-3xl font-bold text-red-600">
                            {{ $detallePartido->goles_visitante }}
                        </span>
                    </div>
                    @forelse($detallePartido->detalles->where('equipo_id', $detallePartido->equipo_visitante_id) as $detalle)
                        @php
                            // Buscar el equipo específico en la colección de equipos del jugador
                            $equipoJugador = $detalle->jugador->equipos->find($detalle->equipo_id);
                        @endphp
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-3">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-xs">
                                        ✓
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $detalle->jugador->name }} {{ $detalle->jugador->apellido }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ $equipoJugador->pivot->posicion ?? 'N/A' }} - 
                                            #{{ $equipoJugador->pivot->num_camiseta ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $detalle->tipo_participacion === 'titular' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($detalle->tipo_participacion) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-3 border-t border-gray-300">
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">⚽ Goles</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $detalle->goles }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🎯 Asistencias</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $detalle->asistencias }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🟨 Amarillas</p>
                                    <p class="text-xl font-bold text-yellow-600">{{ $detalle->tarjetas_amarillas }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">🟥 Rojas</p>
                                    <p class="text-xl font-bold text-red-600">{{ $detalle->tarjetas_rojas }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">
                            No hay jugadores registrados en este partido
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="mt-6 flex justify-between">
                <a href="{{ route('detallePartidos.index') }}" 
                   class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Volver
                </a>
                <a href="{{ route('detallePartidos.edit', $detallePartido) }}" 
                   class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    ✏️ Editar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>