<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Datos del Usuario</h1>
    </div>

    <form method="GET" id="userForm" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <!-- Foto de perfil -->
        <div class="mb-4">
            <label for="file_uri" class="block text-sm font-medium text-gray-700 mb-2">Foto de perfil</label>
            <div class="flex items-center">
                <div class="mr-4">
                    <img id="preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300" 
                        src="{{ asset('/img/' . $usuario->file_uri) }}" alt="">
                </div>
            </div>
        </div>

        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="documento" class="block text-sm font-medium text-gray-700 mb-1">Documento Identidad</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card text-gray-400"></i>
                    </div>
                    <input type="text" name="documento" value="{{ $usuario->documento }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento->format('Y-m-d') }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" value="{{ $usuario->name }}" 
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="apellido" value="{{ $usuario->apellido }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </div>
                    <input type="text" name="direccion" value="{{ $usuario->direccion }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input type="tel" name="telefono" value="{{ $usuario->telefono }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                <select name="role" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user-cog  text-gray-400"></i>
                    </div>
                    <input type="text" name="estado" value="{{ $usuario->estado }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" value="{{ $usuario->email }}"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('usuarios.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 transition duration-200">
                <i class="fas fa-times mr-2"></i>Regresar
            </a>
        </div>
    </form>
</x-app-layout>