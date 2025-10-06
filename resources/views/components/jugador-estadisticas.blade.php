@props(['jugador', 'equipo'])

<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-3 hover:bg-gray-100 transition-colors">
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center gap-3">
            <input type="checkbox" 
                   id="jugador_{{ $jugador->id }}"
                   name="jugadores_seleccionados[]" 
                   value="{{ $jugador->id}}"
                   class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500"
                   x-model="jugadoresSeleccionados"
                   @change="if(!$event.target.checked) { 
                       document.querySelector('#stats_{{ $jugador->id }}').querySelectorAll('input[type=number]').forEach(i => i.value = 0);
                   }">
            <label for="jugador_{{ $jugador->id }}" class="cursor-pointer">
                <p class="font-semibold text-gray-800">
                    {{ $jugador->name }} {{ $jugador->apellido }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $jugador->pivot->posicion }} - #{{ $jugador->pivot->num_camiseta }}
                </p>
            </label>
        </div>
        
        {{-- Indicador visual de selección --}}
        <div x-show="jugadoresSeleccionados.includes('{{ $jugador->id }}')" 
             class="text-green-600 font-semibold text-sm">
            ✓ Seleccionado
        </div>
    </div>
    
    {{-- Campos de estadísticas (solo visible si está seleccionado) --}}
    <div id="stats_{{ $jugador->id }}"
         x-show="jugadoresSeleccionados.includes('{{ $jugador->id }}')" 
         x-transition
         class="grid grid-cols-2 md:grid-cols-5 gap-3 pt-3 border-t border-gray-300">
        
        <input type="hidden" name="jugadores[{{ $jugador->id }}][jugador_id]" value="{{ $jugador->id }}">
        <input type="hidden" name="jugadores[{{ $jugador->id }}][equipo_id]" value="{{ $equipo->id }}">
        
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">⚽ Goles</label>
            <input type="number" 
                   name="jugadores[{{ $jugador->id }}][goles]" 
                   min="0" value="{{ old('jugadores.'.$jugador->id.'.goles', 0) }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">🎯 Asistencias</label>
            <input type="number" 
                   name="jugadores[{{ $jugador->id }}][asistencias]" 
                   min="0" value="{{ old('jugadores.'.$jugador->id.'.asistencias', 0) }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">🟨 Amarillas</label>
            <input type="number" 
                   name="jugadores[{{ $jugador->id }}][tarjetas_amarillas]" 
                   min="0" value="{{ old('jugadores.'.$jugador->id.'.tarjetas_amarillas', 0) }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
        </div>
        
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">🟥 Rojas</label>
            <input type="number" 
                   name="jugadores[{{ $jugador->id }}][tarjetas_rojas]" 
                   min="0" value="{{ old('jugadores.'.$jugador->id.'.tarjetas_rojas', 0) }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
        </div>
        
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Participación</label>
            <select name="jugadores[{{ $jugador->id }}][tipo_participacion]" 
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="titular">Titular</option>
                <option value="suplente">Suplente</option>
            </select>
        </div>
    </div>
</div>