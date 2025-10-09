<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Equipos</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Equipos</h2>
        <a href="{{ route('equipos.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
             <i class="fas fa-plus mr-2"></i> Nuevo Equipos
        </a>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Escudo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Torneo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscripción</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($equipos as $equipo)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                	<img src="{{ asset('img/' . $equipo->file_uri) }}" alt="Imagen Foto" style="width: 40px; height: 35px">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $equipo->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $equipo->torneo->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $equipo->torneo->inscripcion }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $equipo->inscripcion_factura }}</td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    <a href="{{ route('equipos.edit', $equipo) }}"
                         class="text-blue-600 hover:text-blue-900 mr-3">
                         <i class="fas fa-edit"></i> Editar</a>
                    @role('Administrador')
                        <form action="{{ route('equipos.destroy', $equipo) }}" method="post"
                            onsubmit="event.preventDefault(); confirmAction(this, 'delete-team')">
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
            @if ($equipos->hasPages())
                <x-slot name="pagination">
                    {{ $equipos->links() }}
                </x-slot>
            @endif
            
    </x-responsive-table>
    <x-confirm-modal name="delete-team" title="Eliminar Equipo" buttonText="Eliminar">
        ¿Estás seguro de eliminar este equipo?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>
</x-app-layout>