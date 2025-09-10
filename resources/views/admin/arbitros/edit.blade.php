<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Actualizar Arbitros</h1>
    </div>

    <form action="{{ route('arbitros.update', $arbitro) }}" method="POST" id="userForm" class="space-y-4" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="documento" class="block text-sm font-medium text-gray-700 mb-1">Documento Identidad</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card text-gray-400"></i>
                    </div>
                    <input type="text" name="documento" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('documento') is-invalid @enderror is-valid"
                            placeholder="123456789" value="{{ $arbitro->documento }}">
                </div>
                @error('documento')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_nac" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_nac" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                            form-control @error('fecha_nac') is-invalid @enderror is-valid" 
                            value="{{ old('fecha_nac', $arbitro->fecha_nac->format('Y-m-d')) }}">
                </div>
                @error('fecha_nac')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="nombre" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('nombre') is-invalid @enderror is-valid"
                        placeholder="Juan" value="{{ $arbitro->nombre }}">
                </div>
                @error('nombre')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="apellido" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('apellido') is-invalid @enderror is-valid"
                        placeholder="Pérez" value="{{ $arbitro->apellido }}">
                </div>
                @error('apellido')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </div>
                    <input type="text" name="direccion" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('direccion') is-invalid @enderror is-valid"
                        placeholder="Calle, número, ciudad" value="{{ $arbitro->direccion }}">
                </div>
                @error('direccion')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input type="tel" name="telefono"class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('telefono') is-invalid @enderror is-valid"
                        placeholder="099 123 567" value="{{ $arbitro->telefono }}">
                </div>
                @error('telefono')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('email') is-invalid @enderror is-valid"
                        placeholder="correo@ejemplo.com" value="{{ $arbitro->email }}">
                </div>
                @error('email')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('arbitros.index') }}"
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