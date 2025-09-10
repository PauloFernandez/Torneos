<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Actualizar Usuario</h1>
    </div>

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" id="userForm" class="space-y-4" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!-- Foto de perfil -->
        <div class="mb-4">
            <label for="file_uri" class="block text-sm font-medium text-gray-700 mb-2">Foto de perfil</label>
            <div class="flex items-center">
                <div class="mr-4">
                    <img id="preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300"
                        src="" alt="">
                </div>
                <div class="flex justify-center">
                    <input type="file" id="file_uri" name="file_uri" accept="image/*" class="hidden form-control @error('file_uri') is-invalid @enderror is-valid"
                        onchange="previewImage(this)">
                    <label for="file_uri"
                        class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-upload mr-1"></i> Subir imagen
                    </label>
                    <div class="text-xs/5 text-gray-600 px-2 py-2">
                        PNG, JPG menor a 10MB
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
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="documento" class="block text-sm font-medium text-gray-700 mb-1">Documento Identidad</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-id-card text-gray-400"></i>
                    </div>
                    <input type="text" name="documento" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('documento') is-invalid @enderror is-valid"
                        value="{{ $usuario->documento }}">
                </div>
                @error('documento')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_nacimiento" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('fecha_nacimiento') is-invalid @enderror is-valid"
                        value="{{ $usuario->fecha_nacimiento->format('Y-m-d') }}">
                </div>
                @error('fecha_nacimiento')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('name') is-invalid @enderror is-valid"
                        value="{{ $usuario->name }}">
                </div>
                @error('name')
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
                        value="{{ $usuario->apellido }}">
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
                        value="{{ $usuario->direccion }}">
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
                    <input type="tel" name="telefono" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('telefono') is-invalid @enderror is-valid"
                        value="{{ $usuario->telefono }}">
                </div>
                @error('telefono')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
                <select name="estado"
                    class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="activo" selected>Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('email') is-invalid @enderror is-valid"
                        value="{{ $usuario->email }}">
                </div>
                @error('email')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('password') is-invalid @enderror is-valid"
                        value="{{ $usuario->password }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-eye-slash toggle-password text-gray-400 hover:text-gray-600"
                            onclick="togglePassword('password')"></i>
                    </div>
                </div>
                <div class="mt-1 text-xs text-gray-500">
                    La contraseña debe tener al menos 8 caracteres, incluir números y letras.
                </div>
                @error('password')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('usuarios.index') }}"
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
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

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