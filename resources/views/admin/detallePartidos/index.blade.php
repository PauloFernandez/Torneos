<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Carga de Detalles de Partidos</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Partidos</h2>
    </div>

    <x-responsive-table>
        <x-slot name="head">
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Torneo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">hora</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LOCAL</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resultado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VISITANTE</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ( $detallePartidos as $detallePartido ) 
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detallePartido->torneo->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detallePartido->fecha->format('d/m/Y')}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detallePartido->hora }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detallePartido->equipoLocal->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold">
                    <span class="text-lg">{{ $detallePartido->goles_local }}</span> 
                    <span class="font-bold text-gray-500">VS</span>
                    <span class="text-lg">{{ $detallePartido->goles_visitante }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detallePartido->equipoVisitante->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <a href="{{ route('detallePartidos.show', $detallePartido) }}">
                        {{ $detallePartido->estado }}
                    </a>
                </td>
                 {{-- Botones --}}
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                    <a href="{{ route('detallePartidos.edit', $detallePartido) }}" class="text-blue-600 hover:text-blue-900">
                         <i class="fas fa-edit"></i> Cargar</a>
                    {{-- Botón de Eliminar --}}
                      @role('Administrador')
                         <form action="{{ route('detallePartidos.destroy', $detallePartido) }}" method="post"
                             onsubmit="event.preventDefault(); confirmAction(this, 'delete-detallePartido')">
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
                      <td colspan="5" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay partidos ingresados</td>
                  </tr>
            @endforelse
            </x-slot>
            {{-- Si usas paginación de Laravel 
            
            @if ($detallePartidos->hasPages())
                <x-slot name="pagination">
                    {{ $detallePartidos->links() }}
                </x-slot>
            @endif
            --}}
    </x-responsive-table>
        <x-confirm-modal name="delete-detallePartido" title="Eliminar Partido" buttonText="Eliminar">
        ¿Estás seguro de eliminar todo lo cargado a este partido?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>
</x-app-layout>