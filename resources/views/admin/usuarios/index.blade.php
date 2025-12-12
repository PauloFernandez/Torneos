<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-800 flex-shrink-0">
                Administración de Usuarios
            </h1>

            <!-- Formulario de importación -->
            <form action="{{ route('usuarios.import') }}" method="POST" enctype="multipart/form-data"
                  class="flex items-center gap-3 bg-white p-3 rounded-lg shadow-sm border border-gray-200 w-full sm:w-auto">
                @csrf

                <input class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm"
                       type="file" name="document_csv" accept=".csv,.xlsx,.xls">

                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition flex items-center gap-2"
                        type="submit">
                    <i class="fas fa-file-import"></i>Importar
                </button>
            </form>
        </div>
    </x-slot>

    <!-- Alertas de error mejoradas -->
    @if ($errors->any())
        <div class="mb-6">
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden animate-fade-in">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-semibold text-red-800 mb-2">
                                Se {{ $errors->count() > 1 ? 'encontraron' : 'encontró' }} {{ $errors->count() }} {{ $errors->count() > 1 ? 'errores' : 'error' }}:
                            </h3>
                            <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" onclick="this.closest('.animate-fade-in').remove()" 
                                class="flex-shrink-0 ml-3 text-red-400 hover:text-red-600 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Usuarios</h2>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <form action="{{ route('usuarios.index') }}" method="get" class="flex-1 sm:flex-initial">
                @csrf
                <div class="flex gap-2">
                    <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                           type="text" name="search" value="{{ old('search') }}" placeholder="Buscar usuario...">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                            type="submit"><i class="fas fa-magnifying-glass mr-1"></i>Buscar
                    </button>
                </div>
            </form>
            @can('Nuevo Usuario')
                {{-- Cargar el linck usuarios.create aqui --}}
            @endcan
            <a href="{{ route('usuarios.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nuevo Usuario
            </a>
        </div>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($usuarios as $usuario)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <a href="{{ route('usuarios.show', $usuario) }}">
                        <img src="{{ asset('img/' . $usuario->file_uri) }}" alt="Imagen Foto" style="width: 40px; height: 35px">
                    </a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->documento }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->apellido }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->telefono }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $usuario->estado }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @foreach ($usuario->roles as $rol)
                        {{ $rol->name }}
                    @endforeach
                </td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    <a href="{{ route('usuarios.edit', $usuario) }}"
                         class="text-blue-600 hover:text-blue-900 mr-3">
                         <i class="fas fa-edit"></i> Editar</a>
                    @role('Administrador')
                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="post"
                            onsubmit="event.preventDefault(); confirmAction(this, 'delete-user')">
                            @csrf
                            @method('delete')
                            <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Eliminar</button>
                        </form>
                    @endrole
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay datos ingresados</td>
                </tr>
            @endforelse
        </x-slot>
        {{-- Si usas paginación de Laravel --}}
        @if ($usuarios->hasPages())
            <x-slot name="pagination">
                {{ $usuarios->links() }}
            </x-slot>
        @endif
    </x-responsive-table>

    <x-confirm-modal name="delete-user" title="Eliminar Usuario" buttonText="Eliminar">
        ¿Estás seguro de eliminar este usuario?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</x-app-layout>