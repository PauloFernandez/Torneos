<x-app-layout>
    <div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm justify-between p-4">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Administracion de Noticias</h1>
                </div>
            </header>
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Lista de Noticias</h2>
                        <a href="{{ route('noticias.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i> Nueva Noticia
                        </a>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            titulo</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            descripcion</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            fecha publicado</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Autor</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($noticias as $noticia)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $noticia->titulo }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $noticia->descripcion }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $noticia->fecha_publicado->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $noticia->user->name ?? 'Usuario eliminado' }}
                                            </td>
                                            <!-- Botones -->
                                            <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                                                <a href="{{ route('noticias.edit', $noticia) }}"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                                
                                                    <form action="{{ route('noticias.destroy', $noticia) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                                    </form>  
                                            </td>
                                    @empty
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                No hay noticias registradas
                                            </td>
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>