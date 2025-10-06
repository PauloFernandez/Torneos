<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Registrar Partido</h1>
    </div>

    <form action="{{ route('partidos.update', $partido) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('fecha') is-invalid @enderror is-valid"
                            value="{{ old('fecha', $partido->fecha->format('Y-m-d')) }}">
                </div>
                @error('fecha')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-clock text-gray-400"></i> {{-- Icono de reloj para la hora --}}
                    </div>
                    <input type="time" name="hora" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('hora') is-invalid @enderror is-valid"
                        value="{{ old('hora', $partido->hora) }}">
                </div>
                @error('hora')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <label for="torneo_id" class="block text-sm font-medium text-gray-700 mb-1">Torneo</label>
                <select name="torneo_id" id="torneo_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('torneo_id') is-invalid @enderror is-valid">
                    @foreach ($torneos as $torneo)
                        {{-- Preservar el valor seleccionado si hay un error de validación --}}
                        <option value="{{ $torneo->id }}" {{ old('torneo_id', $partido->torneo_id) == $torneo->id ? 'selected' : '' }}>
                            {{ $torneo->nombre }}
                        </option>
                    @endforeach
                </select>
                 @error('torneo_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="flex-1">
                <label for="arbitro_id" class="block text-sm font-medium text-gray-700 mb-1">Arbitro</label>
                <select name="arbitro_id" id="arbitro_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('arbitro_id') is-invalid @enderror is-valid">
                    @foreach ($arbitros as $arbitro)
                        <option value="{{ $arbitro->id }}" {{ old('arbitro_id', $partido->arbitro_id) == $arbitro->id ? 'selected' : '' }}>
                            {{ $arbitro->nombre }}
                        </option>
                    @endforeach
                </select>
                 @error('arbitro_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="flex-1">
                <label for="cancha_id" class="block text-sm font-medium text-gray-700 mb-1">Cancha</label>
                <select name="cancha_id" id="cancha_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('cancha_id') is-invalid @enderror is-valid">
                    @foreach ($canchas as $cancha)
                        <option value="{{ $cancha->id }}" {{ old('cancha_id', $partido->cancha_id) == $cancha->id ? 'selected' : '' }}>
                            {{ $cancha->nombre }}
                        </option>
                    @endforeach
                </select>
                 @error('cancha_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
            {{-- Selectores de Equipo Local y Visitante (se llenarán con JS) --}}
            <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="equipo_local_id" class="block text-sm font-medium text-gray-700 mb-1">Equipo Local</label>
                <select name="equipo_local_id" id="equipo_local_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('equipo_local_id') is-invalid @enderror is-valid">
                    {{-- Opciones se llenarán dinámicamente con JavaScript --}}
                    
                </select>
                 @error('equipo_local_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="equipo_visitante_id" class="block text-sm font-medium text-gray-700 mb-1">Equipo Visitante</label>
                <select name="equipo_visitante_id" id="equipo_visitante_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('equipo_visitante_id') is-invalid @enderror is-valid">
                    {{-- Opciones se llenarán dinámicamente con JavaScript --}}
                </select>
                 @error('equipo_visitante_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-4 flex justify-center">
            <a href="{{ route('partidos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 transition duration-200">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Guardar
            </button>
        </div>
    </form>

    {{-- Script JavaScript al final del body para manipular los selects --}}
    <script>
        // Convertimos la colección de Eloquent a un array JSON de JavaScript
        const allEquipos = @json($equipos);

        const torneoSelect = document.getElementById('torneo_id');
        const equipoLocalSelect = document.getElementById('equipo_local_id');
        const equipoVisitanteSelect = document.getElementById('equipo_visitante_id');

        // Función para poblar los selectores de equipos
        function populateEquipos(selectedTorneoId, oldEquipoLocalId = null, oldEquipoVisitanteId = null) {
            // Limpiar los selectores de equipos
            equipoLocalSelect.innerHTML = '';
            equipoVisitanteSelect.innerHTML = '';

            // Opción por defecto
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Seleccione un equipo';
            equipoLocalSelect.appendChild(defaultOption.cloneNode(true));
            equipoVisitanteSelect.appendChild(defaultOption.cloneNode(true));


            // Filtrar equipos que pertenecen al torneo seleccionado
            const filteredEquipos = allEquipos.filter(equipo => equipo.torneo_id == selectedTorneoId);

            filteredEquipos.forEach(equipo => {
                // Para Equipo Local
                const optionLocal = document.createElement('option');
                optionLocal.value = equipo.id;
                optionLocal.textContent = equipo.nombre;
                // Si hay un valor old y coincide, o si es el equipo local del partido actual, lo selecciona
                if (oldEquipoLocalId && equipo.id == oldEquipoLocalId || {{ old('equipo_local_id', $partido->equipo_local_id) }} == equipo.id) {
                    optionLocal.selected = true;
                }
                equipoLocalSelect.appendChild(optionLocal);

                // Para Equipo Visitante
                const optionVisitante = document.createElement('option');
                optionVisitante.value = equipo.id;
                optionVisitante.textContent = equipo.nombre;
                // Si hay un valor old y coincide, o si es el equipo visitante del partido actual, lo selecciona
                if (oldEquipoVisitanteId && equipo.id == oldEquipoVisitanteId || {{ old('equipo_visitante_id', $partido->equipo_visitante_id) }} == equipo.id) {
                    optionVisitante.selected = true;
                }
                equipoVisitanteSelect.appendChild(optionVisitante);
            });
        }

        // Event listener para cuando el valor del selector de Torneo cambie
        torneoSelect.addEventListener('change', function() {
            // Cuando cambia el torneo, limpiamos y volvemos a poblar los equipos.
            // No pasamos valores old para los equipos porque la selección anterior ya no es relevante
            populateEquipos(this.value);
        });

        // Al cargar la página, si hay un valor antiguo para el torneo (por ejemplo, después de un error de validación),
        // cargamos los equipos correspondientes y los valores antiguos de los equipos.
        const initialTorneoId = torneoSelect.value;
        // Obtenemos los valores de los equipos local y visitante del partido que se está editando
        const currentEquipoLocalId = "{{ old('equipo_local_id', $partido->equipo_local_id) }}";
        const currentEquipoVisitanteId = "{{ old('equipo_visitante_id', $partido->equipo_visitante_id) }}";

        if (initialTorneoId) {
            populateEquipos(initialTorneoId, currentEquipoLocalId, currentEquipoVisitanteId);
        }

    </script>
</x-app-layout>