<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Asignar jugador al Equipo</h1>
    </div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <form action="{{ route('jugadores.create') }}" method="get">
            @csrf
                <div class="flex gap-2">
                    <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                           type="text" name="search" value="{{ old('search') }}" placeholder="Buscar jugador...">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                        type="submit"><i class="fas fa-magnifying-glass mr-1"></i>Buscar
                    </button>
                </div>
            </form>
        </div>


    <form action="{{ route('jugadores.store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="equipo_id" class="block text-sm font-medium text-gray-700 mb-1">Equipo</label>
                <select name="equipo_id" id="equipo_id"
                        class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                form-select @error('equipo_id') @enderror">
                <option selected disabled>Seleccionar equipo</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('equipo_id')
                    <span class="text-red-600 text-sm mt-1">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Información básica jugador -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asignar</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Foto</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Apellido</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Posición</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nº Camiseta</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                       @forelse ($jugadores as $index => $jugador) 
                            <tr class="@if($errors->has("jugadores.{$index}.num_camiseta")) bg-red-50 @endif">
                                <td class="px-10 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="jugadores[{{ $index }}][seleccionado]" 
                                               value="1"
                                               {{ old("jugadores.{$index}.seleccionado") ? 'checked' : '' }}
                                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                        <input type="hidden" name="jugadores[{{ $index }}][user_id]" value="{{ $jugador->id }}">
                                    </div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm">
                                    <img src="{{ asset('img/' . $jugador->file_uri) }}" alt="Imagen Foto"
                                            style="width: 40px; height: 35px">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    {{ $jugador->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $jugador->apellido }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <select name="jugadores[{{ $index }}][posicion]"
                                        class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                               @error("jugadores.{$index}.posicion") border-red-500 @enderror">
                                        <option value="">Seleccionar posición</option>
                                        <option value="POR" {{ old("jugadores.{$index}.posicion") == 'POR' ? 'selected' : '' }}>POR</option>
                                        <option value="DFC" {{ old("jugadores.{$index}.posicion") == 'DFC' ? 'selected' : '' }}>DFC</option>
                                        <option value="LD" {{ old("jugadores.{$index}.posicion") == 'LD' ? 'selected' : '' }}>LD</option>
                                        <option value="LI" {{ old("jugadores.{$index}.posicion") == 'LI' ? 'selected' : '' }}>LI</option>
                                        <option value="MCD" {{ old("jugadores.{$index}.posicion") == 'MCD' ? 'selected' : '' }}>MCD</option>
                                        <option value="MC" {{ old("jugadores.{$index}.posicion") == 'MC' ? 'selected' : '' }}>MC</option>
                                        <option value="MCO" {{ old("jugadores.{$index}.posicion") == 'MCO' ? 'selected' : '' }}>MCO</option>
                                        <option value="ED" {{ old("jugadores.{$index}.posicion") == 'ED' ? 'selected' : '' }}>ED</option>
                                        <option value="EI" {{ old("jugadores.{$index}.posicion") == 'EI' ? 'selected' : '' }}>EI</option>
                                        <option value="SP" {{ old("jugadores.{$index}.posicion") == 'SP' ? 'selected' : '' }}>SP</option>
                                        <option value="DC" {{ old("jugadores.{$index}.posicion") == 'DC' ? 'selected' : '' }}>DC</option>
                                    </select>
                                    @error("jugadores.{$index}.posicion")
                                        <span class="text-red-600 text-xs mt-1 block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <input type="number" 
                                           name="jugadores[{{ $index }}][num_camiseta]" 
                                           min="1" 
                                           max="99"
                                           value="{{ old("jugadores.{$index}.num_camiseta") }}"
                                           placeholder="Ej: 10"
                                           class="block pl-3 pr-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 w-full
                                                  @error("jugadores.{$index}.num_camiseta") border-red-500 @enderror">
                                    @error("jugadores.{$index}.num_camiseta")
                                        <span class="text-red-600 text-xs mt-1 block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-lg font-semibold text-gray-800 text-center">
                                    No hay jugadores disponibles para asignar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Error para jugadores no seleccionados -->
        @error('jugadores_seleccionados')
            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle mr-2 mt-0.5"></i>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @enderror

        <!-- Botones -->
        <div class="mt-4 flex justify-center">
            <a href="{{ route('jugadores.index') }}"
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