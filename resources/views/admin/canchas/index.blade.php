<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Canchas</h1>
    </x-slot>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Canchas</h2>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <form action="{{ route('canchas.index') }}" method="get" class="flex-1 sm:flex-initial">
                @csrf
                    <div class="flex gap-2">
                        <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                               type="text" name="search" value="{{ old('search') }}" placeholder="Buscar cancha...">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                                type="submit">
                                <i class="fas fa-magnifying-glass mr-1"></i>Buscar
                        </button>
                    </div>
            </form>
            @can('Nueva Cancha')
            <a href="{{ route('canchas.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nueva Cancha
            </a> 
            @endcan
        </div>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">$ hora</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo superficie</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Techada</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Iluminacion</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vestuario</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($canchas as $cancha)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->precio_por_hora }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->tipo_superficie }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->estado }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->techada ? 'Sí' : 'No' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->iluminacion ? 'Sí' : 'No' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->vestuario ? 'Sí' : 'No' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $cancha->observaciones }}</td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    @can('Editar Cancha')
                    <a href="{{ route('canchas.edit', $cancha) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-edit"></i> Editar
                    </a> 
                    @endcan
                    
                    @can('Eliminar Cancha')
                    <form action="{{ route('canchas.destroy', $cancha) }}" method="post"
                            onsubmit="event.preventDefault(); confirmAction(this, 'delete-cancha')">
                            @csrf
                            @method('delete')
                        <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Eliminar</button>
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
            @if ($canchas->hasPages())
                <x-slot name="pagination">
                    {{ $canchas->links() }}
                </x-slot>
            @endif
            
    </x-responsive-table>

    <x-confirm-modal name="delete-cancha" title="Eliminar Cancha" buttonText="Eliminar">
        ¿Estás seguro de eliminar esta cancha?<br>
        <small class="text-gray-500 mt-1 block">Esta acción no se puede deshacer.</small>
    </x-confirm-modal>
</x-app-layout>