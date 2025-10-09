<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Torneos</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Torneos</h2>
        <a href="{{ route('torneos.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
             <i class="fas fa-plus mr-2"></i> Nuevo Torneo
        </a>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">inscripcion</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">valor cancha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha inicio</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha fin</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">categoria</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">premio</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($torneos as $torneo)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm"><a href="{{ route('torneos.show', $torneo) }}">{{ $torneo->nombre }}</a></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->inscripcion }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->valor_cancha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->fecha_inicio->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->fecha_fin->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->categoria }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $torneo->premio }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @if ($torneo->estado == 1)
                        <span class="text-green-600">Activo</span>
                    @else
                        <span class="text-red-600">Inactivo</span>
                    @endif
                </td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    <a href="{{ route('torneos.edit', $torneo) }}"
                         class="text-blue-600 hover:text-blue-900 mr-3">
                         <i class="fas fa-edit"></i> Editar</a>
                    @role('Administrador')
                        <form action="{{ route('torneos.destroy', $torneo) }}" method="post"
                            onsubmit="event.preventDefault(); confirmAction(this, 'delete-torneo')">
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
            @if ($torneos->hasPages())
                <x-slot name="pagination">
                    {{ $torneos->links() }}
                </x-slot>
            @endif
    </x-responsive-table>
    <x-confirm-modal name="delete-torneo" title="Eliminar Torneo" buttonText="Eliminar">
        ¿Estás seguro de eliminar este torneo?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>
</x-app-layout>