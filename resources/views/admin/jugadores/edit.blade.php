<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Actualizar jugador al Equipo</h1>
    </div>

    <form action="{{ route('jugadores.update', $jugador) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="equipo_id" class="block text-sm font-medium text-gray-700 mb-1">Equipo</label>
                <select name="equipo_id" id="equipo_id"
                        class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                form-select @error('equipo_id') border-red-500 @enderror">
                    <option value="">Seleccionar equipo</option>
                    @foreach ($equipos as $equipoOption)
                        <option value="{{ $equipoOption->id }}" 
                            {{ (old('equipo_id', $equipo->id) == $equipoOption->id) ? 'selected' : '' }}>
                            {{ $equipoOption->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('equipo_id')
                    <span class="text-red-600 text-sm mt-1 block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Información del jugador -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">Datos del Jugador</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Foto del jugador -->
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('img/' . $jugador->file_uri) }}" alt="Foto del jugador" class="w-24 h-24 rounded-full object-cover border-4 border-gray-200">
                        <p class="mt-2 text-sm font-medium text-gray-900">{{ $jugador->name }} {{ $jugador->apellido }}</p>
                        <p class="text-sm text-gray-500">Documento: {{ $jugador->documento }}</p>
                    </div>

                    <!-- Posición -->
                    <div>
                        <label for="posicion" class="block text-sm font-medium text-gray-700 mb-2">Posición</label>
                        <select name="posicion" id="posicion" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                   @error('posicion') border-red-500 @enderror">
                            <option value="POR" {{ (old('posicion', $pivotData->pivot->posicion) == 'POR') ? 'selected' : '' }}>Portero (POR)</option>
                            <option value="DFC" {{ (old('posicion', $pivotData->pivot->posicion) == 'DFC') ? 'selected' : '' }}>Defensa Central (DFC)</option>
                            <option value="LD" {{ (old('posicion', $pivotData->pivot->posicion) == 'LD') ? 'selected' : '' }}>Lateral Derecho (LD)</option>
                            <option value="LI" {{ (old('posicion', $pivotData->pivot->posicion) == 'LI') ? 'selected' : '' }}>Lateral Izquierdo (LI)</option>
                            <option value="MCD" {{ (old('posicion', $pivotData->pivot->posicion) == 'MCD') ? 'selected' : '' }}>Mediocampo Defensivo (MCD)</option>
                            <option value="MC" {{ (old('posicion', $pivotData->pivot->posicion) == 'MC') ? 'selected' : '' }}>Mediocampo (MC)</option>
                            <option value="MCO" {{ (old('posicion', $pivotData->pivot->posicion) == 'MCO') ? 'selected' : '' }}>Mediocampo Ofensivo (MCO)</option>
                            <option value="ED" {{ (old('posicion', $pivotData->pivot->posicion) == 'ED') ? 'selected' : '' }}>Extremo Derecho (ED)</option>
                            <option value="EI" {{ (old('posicion', $pivotData->pivot->posicion) == 'EI') ? 'selected' : '' }}>Extremo Izquierdo (EI)</option>
                            <option value="SP" {{ (old('posicion', $pivotData->pivot->posicion) == 'SP') ? 'selected' : '' }}>Segundo Punta (SP)</option>
                            <option value="DC" {{ (old('posicion', $pivotData->pivot->posicion) == 'DC') ? 'selected' : '' }}>Delantero Centro (DC)</option>
                        </select>
                        @error('posicion')
                            <span class="text-red-600 text-xs mt-1 block">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Número de camiseta -->
                    <div>
                        <label for="num_camiseta" class="block text-sm font-medium text-gray-700 mb-2">Número de Camiseta</label>
                        <input type="number" name="num_camiseta" id="num_camiseta" min="1" max="99"
                               value="{{ old('num_camiseta', $pivotData->pivot->num_camiseta) }}"
                               class="block w-full pl-3 pr-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                      @error('num_camiseta') border-red-500 @enderror">
                        @error('num_camiseta')
                            <span class="text-red-600 text-xs mt-1 block">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Información Actual:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Equipo actual:</span> 
                            <span class="text-indigo-600">{{ $equipo->nombre }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Posición actual:</span> 
                            <span class="text-indigo-600">{{ $pivotData->pivot->posicion ?: 'Sin asignar' }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Camiseta actual:</span> 
                            <span class="text-indigo-600">{{ $pivotData->pivot->num_camiseta ?: 'Sin asignar' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-6 flex justify-center space-x-3">
            <a href="{{ route('jugadores.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-md transition duration-200 flex items-center">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition duration-200 flex items-center">
                <i class="fas fa-save mr-2"></i> Actualizar
            </button>
        </div>
    </form>

    <!-- Script para mejorar UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const equipoSelect = document.getElementById('equipo_id');

            // Mostrar advertencia si cambia de equipo
            equipoSelect.addEventListener('change', function() {
                const equipoActual = {{ $equipo->id }};
                if (this.value != equipoActual) {
                    const warning = document.createElement('div');
                    warning.className = 'mt-2 p-2 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded text-xs';
                    warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Al cambiar de equipo, se verificará que el número de camiseta esté disponible.';
                    
                    // Remover warning anterior si existe
                    const oldWarning = equipoSelect.parentNode.querySelector('.bg-yellow-100');
                    if (oldWarning) oldWarning.remove();
                    
                    equipoSelect.parentNode.appendChild(warning);
                } else {
                    // Remover warning si vuelve al equipo original
                    const oldWarning = equipoSelect.parentNode.querySelector('.bg-yellow-100');
                    if (oldWarning) oldWarning.remove();
                }
            });
        });
    </script>
</x-app-layout>