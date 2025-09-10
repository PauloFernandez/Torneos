<x-app-layout>
    <div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm justify-between p-4">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Administracion de Canchas</h1>
                </div>
            </header>
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Lista de Canchas</h2>
                        <a href="{{ route('canchas.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i> Nueva Cancha
                        </a>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            $ hora</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo superficie</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Techada</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Iluminacion</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Vestuario</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Observaciones</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($canchas as $cancha)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->nombre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->precio_por_hora }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->tipo_superficie }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->estado }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->techada ? 'Sí' : 'No' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->iluminacion ? 'Sí' : 'No' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->vestuario ? 'Sí' : 'No' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $cancha->observaciones }}
                                            </td>
                                            <!-- Botones -->
                                            <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
                                                <a href="{{ route('canchas.edit', $cancha) }}"
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                    <i class="fas fa-edit"></i> Editar</a>
                                                    @role('Administrador')
                                                    <form action="{{ route('canchas.destroy', $cancha) }}" method="post"
                                                        onsubmit="event.preventDefault(); confirmAction(this, 'delete-cancha')">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="text-red-600 hover:text-red-900">
                                                            <i class="fas fa-trash"></i> Eliminar</button>
                                                    </form>  
                                                     @endrole
                                            </td>
                                    @empty
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                No hay canchas registradas
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
    <x-confirm-modal name="delete-cancha" title="Eliminar Cancha" buttonText="Eliminar">
        ¿Estás seguro de eliminar esta cancha?<br>
        <small class="text-gray-500 mt-1 block">Esta acción no se puede deshacer.</small>
    </x-confirm-modal>
</x-app-layout>