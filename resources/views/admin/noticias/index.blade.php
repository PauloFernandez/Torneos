<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Noticias</h1>
    </x-slot>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Noticias</h2>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <form action="{{ route('noticias.index') }}" method="get" class="flex-1 sm:flex-initial">
            @csrf
                <div class="flex gap-2">
                    <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                           type="text" name="search" value="{{ old('search') }}" placeholder="Buscar noticias...">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                        type="submit"><i class="fas fa-magnifying-glass mr-1"></i>Buscar
                    </button>
                </div>
            </form>

            <a href="{{ route('noticias.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nueva Noticia
            </a>
        </div>
    </div>

    <x-responsive-table>
        <x-slot name="head">                            
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">titulo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">descripcion</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha publicado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($noticias as $noticia)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $noticia->titulo }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $noticia->descripcion }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $noticia->fecha_publicado->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $noticia->user->name ?? 'Usuario eliminado' }}</td>
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                    <a href="{{ route('noticias.edit', $noticia) }}"
                         class="text-blue-600 hover:text-blue-900 mr-3">
                         <i class="fas fa-edit"></i> Editar</a>
                    @role('Administrador')
                        <form action="{{ route('noticias.destroy', $noticia) }}" method="post"
                            onsubmit="event.preventDefault(); confirmAction(this, 'delete-noticia')">
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
            @if ($noticias->hasPages())
                <x-slot name="pagination">
                    {{ $noticias->links() }}
                </x-slot>
            @endif
          
    </x-responsive-table>
    <x-confirm-modal name="delete-noticia" title="Eliminar Noticia" buttonText="Eliminar">
        ¿Estás seguro de eliminar esta noticia?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>
</x-app-layout>