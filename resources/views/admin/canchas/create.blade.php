<x-app-layout>
    <div class="text-center mb-9 mt-5">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Registrar Cancha</h1>
    </div>

    <form action="{{ route('canchas.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-futbol text-gray-400"></i>
                    </div>
                    <input type="text" name="nombre" placeholder="Indique el nombre de la cancha"
                     class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('nombre') is-invalid @enderror is-valid" value="{{ old('nombre') }}">
                </div>
                @error('nombre')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="precio_por_hora" class="block text-sm font-medium text-gray-700 mb-1">Consto por hora</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dollar-sign text-gray-400"></i>
                    </div>
                    <input type="number" name="precio_por_hora" value="{{ old('precio_por_hora') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                           form-control @error('precio_por_hora') is-invalid @enderror is-valid">
                </div>
                @error('precio_por_hora')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="tipo_superficie" class="block text-sm font-medium text-gray-700 mb-1">Tipo superficie</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-layer-group text-gray-400 mr-2"></i>
                    </div>
                    <select name="tipo_superficie"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('precio_por_hora') is-invalid @enderror is-valid">
                        <option value="" selected>Seleccionar tipo de superficie</option>
                        <option value="cesped_natural">Césped natural</option>
                        <option value="cesped_artificial">Césped sintético</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                @error('tipo_superficie')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-clipboard-check text-gray-400 mr-2"></i>
                    </div>
                    <select name="estado"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('estado') is-invalid @enderror is-valid">
                        <option value="" selected>Seleccionar estado</option>
                        <option value="disponible">Disponible</option>
                        <option value="ocupada">Ocupada</option>
                        <option value="mantenimiento">Mantenimiento</option>
                    </select>
                </div>
                @error('estado')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Checkboxes en una sola línea -->
            <div class="col-span-2">
                <div class="flex flex-wrap gap-6 mt-3">
                    <div class="flex items-center">
                        <input type="checkbox" name="techada" value="1" @if (old('techada') == 1) checked @endif
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="techada" class="ml-2 text-sm font-medium text-gray-700">
                            Techada
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="iluminacion" value="1" @if (old('iluminacion') == 1) checked @endif
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="iluminacion" class="ml-2 text-sm font-medium text-gray-700">
                            Iluminación
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="vestuario" value="1" @if (old('vestuario') == 1) checked @endif
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="vestuario" class="ml-2 text-sm font-medium text-gray-700">
                            Vestuario
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
                <div>
                    <textarea name="observaciones" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                        value="{{ old('observaciones') }}">
                    </textarea>
                </div>
            </div>
        </div>
        <!-- Botones -->
        <div class="mt-4 flex justify-center">
            <a href="{{ route('canchas.index') }}"
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