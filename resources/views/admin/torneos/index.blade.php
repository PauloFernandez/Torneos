<x-app-layout>
    <div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm justify-between p-4">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Administracion de Torneos</h1>
                </div>
            </header>
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Lista de Torneos</h2>
                        <a href="{{ route('torneos.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i> Nuevo Torneo
                        </a>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            nombre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            inscripcion</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            valor cancha</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            fecha inicio</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            fecha fin</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            categoria</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            premio</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($torneos as $torneo)
                                        <tr>
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
                                                    class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                                 @role('Administrador')
                                                    <form action="{{ route('torneos.destroy', $torneo) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                                    </form>
                                                @endrole
                                            </td>
                                        @empty
                                            <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">No hay torneos ingresados</td>
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