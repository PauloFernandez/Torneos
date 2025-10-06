<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Jugadores</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Jugadores por Equipos</h2>
        <a href="{{ route('jugadores.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
             <i class="fas fa-plus mr-2"></i> Asignar Jugador
        </a>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posición</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nº Camiseta</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($jugadores as $jugador)
                @foreach ($jugador->equipos as $equipo)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <img src="{{ asset('img/' . $jugador->file_uri) }}" alt="Imagen Foto" class="w-10 h-10 rounded-full object-cover">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $jugador->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $jugador->apellido }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center">
                            <img src="{{ asset('img/' . $equipo->file_uri) }}" alt="Escudo" class="w-6 h-6 rounded-full object-cover mr-2">
                            {{ $equipo->nombre }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $equipo->pivot->posicion ?? 'Sin asignar' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-800 font-semibold">
                            {{ $equipo->pivot->num_camiseta ?? '-' }}
                        </span>
                    </td>
                    <!-- Botones -->
                    <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('jugadores.edit', [$jugador, $equipo]) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            @role('Administrador')
                                <form action="{{ route('jugadores.destroy', [$jugador, $equipo]) }}" 
                                    method="post" 
                                    onsubmit="event.preventDefault(); confirmAction(this, 'remove-player')">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Remover
                                    </button>
                                </form>
                            @endrole
                        </div>
                    </td>
                </tr>
                @endforeach
            @empty
            <tr>
                 <td colspan="5" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay datos ingresados</td>
            </tr>
            @endforelse
        </x-slot>
            {{-- Si usas paginación de Laravel --}}
            {{--
            @if ($partidos->hasPages())
                <x-slot name="pagination">
                    {{ $partidos->links() }}
                </x-slot>
            @endif
            --}}
    </x-responsive-table>
    {{-- COMPONENTE DEL MODAL - Solo agregar esta línea al final --}}
    <x-confirm-modal name="remove-player" title="Remover Jugador" buttonText="Remover">
        ¿Estás seguro de remover este jugador del equipo?<br>
        <small class="text-gray-500 mt-1 block">Esta acción no se puede deshacer.</small>
    </x-confirm-modal>
</x-app-layout>