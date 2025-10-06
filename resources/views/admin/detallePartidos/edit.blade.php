<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cargar Detalles del Partido
        </h2>
    </x-slot>
@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
        <p class="font-semibold mb-2">Por favor corrige los siguientes errores:</p>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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

            {{-- Formulario en 2 Columnas --}}
            <div x-data="{ jugadoresSeleccionados: [] }">
                <form action="{{ route('detallePartidos.update', $detallePartido) }}" method="POST">
                    @method('PUT')
                    @csrf
                    
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
                            
                            @forelse($jugadoresLocal as $jugador)
                                <x-jugador-estadisticas 
                                    :jugador="$jugador" 
                                    :equipo="$detallePartido->equipoLocal" />
                            @empty
                                <p class="text-gray-500 text-center py-8">
                                    No hay jugadores registrados
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
                            
                            @forelse($jugadoresVisitante as $jugador)
                                <x-jugador-estadisticas 
                                    :jugador="$jugador" 
                                    :equipo="$detallePartido->equipoVisitante" />
                            @empty
                                <p class="text-gray-500 text-center py-8">
                                    No hay jugadores registrados
                                </p>
                            @endforelse
                        </div>

                    </div>

                    {{-- Botones de Acción --}}
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('detallePartidos.index') }}" 
                           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            💾 Guardar Detalles del Partido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>