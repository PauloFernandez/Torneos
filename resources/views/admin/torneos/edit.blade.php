<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Actualizar Torneos</h1>
    </div>

    <form action="{{ route('torneos.update', $torneo ) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-trophy text-gray-400"></i>
                    </div>
                    <input type="text" name="nombre" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('nombre') is-invalid @enderror is-valid"
                            value="{{ $torneo->nombre }}">
                </div>
                @error('nombre')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tags text-gray-400 mr-2"></i>
                    </div>
                    <select name="categoria"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="Masculino" {{ old('categoria', $torneo->categoria) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('categoria', $torneo->categoria) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Mixto" {{ old('categoria', $torneo->categoria) == 'Mixto' ? 'selected' : '' }}>Mixto</option>
                        <option value="Adolecente" {{ old('categoria', $torneo->categoria) == 'Adolecente' ? 'selected' : '' }}>Adolecente</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha de inicio</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_inicio" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('fecha_inicio') is-invalid @enderror is-valid" 
                            value="{{ old('fecha_inicio', $torneo->fecha_inicio->format('Y-m-d')) }}">
                </div>
                @error('fecha_inicio')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha de fin</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_fin" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('fecha_fin') is-invalid @enderror is-valid" 
                            value="{{ old('fecha_fin', $torneo->fecha_fin->format('Y-m-d')) }}">
                </div>
                @error('fecha_fin')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="inscripcion" class="block text-sm font-medium text-gray-700 mb-1">Inscripcion</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dollar-sign text-gray-400"></i>
                    </div>
                    <input type="number" name="inscripcion" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('inscripcion') is-invalid @enderror is-valid" value="{{ $torneo->inscripcion }}" placeholder="1000">
                </div>
                @error('inscripcion')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="valor_cancha" class="block text-sm font-medium text-gray-700 mb-1">Costo cancha</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dollar-sign text-gray-400"></i>
                    </div>
                    <input type="number" name="valor_cancha" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('valor_cancha') is-invalid @enderror is-valid"
                        placeholder="1000" value="{{ $torneo->valor_cancha }}">
                </div>
                @error('valor_cancha')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="premio" class="block text-sm font-medium text-gray-700 mb-1">Premio</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-money-bill-wave  text-gray-400"></i>
                    </div>
                    <input type="number" name="premio" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('premio') is-invalid @enderror is-valid"
                        placeholder="1000" value="{{ $torneo->premio }}">
                </div>
                @error('premio')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="premio_extra" class="block text-sm font-medium text-gray-700 mb-1">Premio extra</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-coins text-gray-400"></i>
                    </div>
                    <input type="tel" name="premio_extra"class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('premio_extra') is-invalid @enderror is-valid"
                        placeholder="Una PlayStation" value="{{ $torneo->premio_extra }}">
                </div>
                @error('premio_extra')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             <div>
                <label for="reglas_gral" class="block text-sm font-medium text-gray-700 mb-1">Reglas generales</label>
                <div>
                    <textarea name="reglas_gral" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('reglas_gral') is-invalid @enderror is-valid">{{ old('reglas_gral', $torneo->reglas_gral) }}
                    </textarea>
                </div>
                @error('reglas_gral')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="sis_competicion" class="block text-sm font-medium text-gray-700 mb-1">Sistema de competicion</label>
                <div>
                    <textarea name="sis_competicion" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('sis_competicion') is-invalid @enderror is-valid">{{ old('sis_competicion', $torneo->sis_competicion) }}
                    </textarea>
                </div>
                @error('sis_competicion')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="requisito_jugador" class="block text-sm font-medium text-gray-700 mb-1">Requisito del jugador</label>
                <div>
                    <textarea name="requisito_jugador" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('requisito_jugador') is-invalid @enderror is-valid">{{ old('requisito_jugador', $torneo->requisito_jugador) }}
                    </textarea>
                </div>
                @error('requisito_jugador')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="disciplina" class="block text-sm font-medium text-gray-700 mb-1">Disciplina</label>
                <div>
                    <textarea name="disciplina" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('disciplina') is-invalid @enderror is-valid">{{ old('disciplina', $torneo->disciplina) }}
                    </textarea>
                </div>
                @error('disciplina')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="cantidad_equipos" class="block text-sm font-medium text-gray-700 mb-1">Cantidad maxima de equipos</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tshirt  text-gray-400"></i>
                    </div>
                    <input type="number" name="cantidad_equipos" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('cantidad_equipos') is-invalid @enderror is-valid"
                        placeholder="1000" value="{{ $torneo->cantidad_equipos }}">
                </div>
                @error('cantidad_equipos')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="flex items-center mt-4">
                <input type="checkbox" name="estado" value="1" @if ($torneo->estado == 1) checked @endif
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                <label for="estado" class="ml-2 text-sm font-medium text-gray-700">
                    Mostrar en Página de Inicio
                </label>
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('torneos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 transition duration-200">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Guardar
            </button>
        </div>
    </form>
</x-app-layout>