<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Registrar Equipos</h1>
    </div>

    <form action="{{ route('equipos.update', $equipo) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Foto de perfil -->
        <div class="mb-4">
            <label for="file_uri" class="block text-sm font-medium text-gray-700 mb-2">Escudo</label>
            <div class="flex items-center">
                <div class="mr-4">
                    <img id="preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300" src="{{ asset('img/' . $equipo->file_uri) }}" alt="">
                </div>
                <div class="flex justify-center">
                    <input type="file" id="file_uri" name="file_uri" accept="image/*" class="hidden" onchange="previewImage(this)"
                         class="form-control @error('file_uri') is-invalid @enderror is-valid">
                    <label for="file_uri" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-upload mr-1"></i> Subir imagen
                    </label>
                    <div class="text-xs/5 text-gray-600 px-2 py-2">
                        PNG, JPG menor a 10MB y máximo 650x650px
                    </div>
                </div>
            </div>
            @error('file_uri')
                <span class="invalid-feedback text-red-600">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Información básica -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="nombre" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('nombre') is-invalid @enderror is-valid"
                        value="{{ old('nombre', $equipo->nombre) }}">
                </div>
                @error('nombre')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="torneo_id" class="block text-sm font-medium text-gray-700 mb-1">Torneo</label>
                <select name="torneo_id" id="torneo_id"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-select @error('torneo_id') is-invalid @enderror is-valid">
                    @foreach ($torneos as $torneo)
                        <option value="{{ $torneo->id }}" id="{{ $torneo->inscripcion }}" {{ $equipo->torneo_id == $torneo->id ? 'selected' : '' }}>
                            {{ $torneo->nombre }}</option>
                    @endforeach
                </select>
                 @error('torneo_id')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select name="estado"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="Pendiente" {{ old('estado', $equipo->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Pagado" {{ old('estado', $equipo->estado) == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                </select>
            </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('equipos.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 transition duration-200">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Guardar
            </button>
        </div>
    </form>

    <script>     
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>