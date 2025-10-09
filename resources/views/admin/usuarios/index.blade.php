<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Usuarios</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
             <i class="fas fa-plus mr-2"></i> Nuevo Usuario
        </a>
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
                    <td colspan="5" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay datos ingresados</td>
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
</x-app-layout>