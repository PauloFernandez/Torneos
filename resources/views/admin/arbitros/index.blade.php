<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Arbitros</h1>
    </x-slot>
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Arbitros</h2>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <form action="{{ route('arbitros.index') }}" method="get" class="flex-1 sm:flex-initial">
            @csrf
                <div class="flex gap-2">
                    <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                            type="text" name="search" value="{{ old('search') }}" placeholder="Buscar arbitro...">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                            type="submit"><i class="fas fa-magnifying-glass mr-1"></i>Buscar
                    </button>
                </div>
            </form>
            @can('Nueva Arbitro')
            <a href="{{ route('arbitros.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nuevo Arbitros
            </a>
            @endcan
        </div>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Nacimiento</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($arbitros as $arbitro)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->documento }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->apellido }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->fecha_nac->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->direccion }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->telefono }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $arbitro->email }}</td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    @can('Editar Arbitro')
                     <a href="{{ route('arbitros.edit', $arbitro) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>Editar
                    </a>   
                    @endcan
                    
                    @can('Eliminar Arbitro')
                    <form action="{{ route('arbitros.destroy', $arbitro) }}" method="post"
                                onsubmit="event.preventDefault(); confirmAction(this, 'delete-arbitro')">
                        @csrf
                        @method('delete')
                        <button class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Eliminar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay datos ingresados</td>
                </tr>
            @endforelse
        </x-slot>
            {{-- Si usas paginación de Laravel --}}
            
            @if ($arbitros->hasPages())
                <x-slot name="pagination">
                    {{ $arbitros->links() }}
                </x-slot>
            @endif
            
    </x-responsive-table>
    <x-confirm-modal name="delete-arbitro" title="Eliminar Arbitro" buttonText="Eliminar">
        ¿Estás seguro de eliminar este arbitro?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>
</x-app-layout>