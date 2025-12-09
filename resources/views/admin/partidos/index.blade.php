<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Administracion de Partidos</h1>
    </x-slot>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Partidos</h2>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <form action="{{ route('partidos.index') }}" method="get" class="flex-1 sm:flex-initial">
            @csrf
                <div class="flex gap-2">
                    <input class="flex-1 sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                           type="text" name="search" value="{{ old('search') }}" placeholder="Buscar partido...">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 whitespace-nowrap"
                        type="submit"><i class="fas fa-magnifying-glass mr-1"></i>Buscar
                    </button>
                </div>
            </form>

            <a href="{{ route('partidos.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nuevo Partidos
            </a>
        </div>
    </div>

    <x-responsive-table>
        <x-slot name="head">
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Torneo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">hora</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">arbitro</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">cancha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LOCAL</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resultado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VISITANTE</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ( $partidos as $partido ) 
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->torneo->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->fecha->format('d/m/Y')}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->hora }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->arbitro->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->cancha->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->equipoLocal->nombre }}</td>
                @if ($partido->goles_local !== null)
                       <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold">
                          <span class="text-lg">{{ $partido->goles_local }}</span> 
                          <span class="font-bold text-gray-500">VS</span>
                          <span class="text-lg">{{ $partido->goles_visitante }}</span>
                      </td>
                @else
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 italic">
                        - <span class="font-bold">VS</span> -
                       </td>
                @endif
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $partido->equipoVisitante->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="font-semibold 
                        @if($partido->estado == 'programado') text-blue-800
                        @elseif($partido->estado == 'suspendido') text-yellow-400
                        @else text-red-700 @endif">
                        {{ ucfirst($partido->estado) }}
                    </span>
                 </td>
                 {{-- Botones --}}
                 <td class="px-4 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                 {{-- Botón de Registrar/Ver Resultados --}}
                     @php
                         // Obtener fecha y hora actual
                         $ahora = now();
                         
                         // Combinar fecha del partido con su hora
                         $fechaHoraPartido = \Carbon\Carbon::parse($partido->fecha->format('Y-m-d') . ' ' . $partido->hora);
                         
                         // El botón se habilita cuando la fecha/hora del partido ya pasó o es ahora
                         $canRegisterResults = $fechaHoraPartido->lessThanOrEqualTo($ahora);
                         
                         // Verificar si ya tiene resultados registrados
                         $hasResults = $partido->goles_local !== null && $partido->goles_visitante !== null;
                     @endphp

                     @if (!$canRegisterResults)
                          <a href="{{ route('partidos.edit', $partido) }}"
                         class="text-blue-600 hover:text-blue-900">
                         <i class="fas fa-edit"></i> Editar</a>
                     @else
                         <button
                         data-partido-id="{{ $partido->id }}"
                         class="text-left transition-colors duration-200 text-xs sm:text-sm
                             @if($hasResults)
                                 hover:text-green-600 text-green-500
                             @else
                                 hover:text-orange-600 text-orange-500
                             @endif"
                         {{ !$canRegisterResults ? 'disabled' : '' }}
                         onclick="openResultsModal({{ $partido->id }})"
                     >
                         @if($hasResults)
                             <i class="fas fa-edit"></i> Resultados
                         @else
                             <i class="fas fa-file-alt"></i> Resultados
                         @endif
                     </button>
                     @endif
                     
                     {{-- Botón de Eliminar --}}
                      @role('Administrador')
                         <form action="{{ route('partidos.destroy', $partido) }}" method="post"
                             onsubmit="event.preventDefault(); confirmAction(this, 'delete-partido')">
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
            {{-- Si usas paginación de Laravel --}}
            @if ($partidos->hasPages())
                <x-slot name="pagination">
                    {{ $partidos->links() }}
                </x-slot>
            @endif
           
    </x-responsive-table>
    <x-confirm-modal name="delete-partido" title="Eliminar Partido" buttonText="Eliminar">
        ¿Estás seguro de eliminar este partido?<br>
        <small class="text-gray-500 mt-1 block">Se perderán todos los datos asociados.</small>
    </x-confirm-modal>

     <!-- Modal para Registrar/Editar Resultados -->
    <div id="resultsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-lg font-bold text-gray-900">Registrar/Editar Resultados del Partido</h3>
                <button onclick="closeResultsModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-2 text-gray-700">
                <form id="updateResultsForm" method="POST" action="">
                    @csrf
                    @method('PUT') {{-- Usamos PUT para la actualización --}}

                    <input type="hidden" name="partido_id" id="modal_partido_id">

                    <div class="mb-4">
                        <label for="modal_equipo_local_nombre" class="block text-sm font-medium text-gray-700">Equipo Local</label>
                        <input type="text" id="modal_equipo_local_nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="modal_goles_local" class="block text-sm font-medium text-gray-700">Goles Local</label>
                        <input type="number" name="goles_local" id="modal_goles_local" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('goles_local') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="modal_equipo_visitante_nombre" class="block text-sm font-medium text-gray-700">Equipo Visitante</label>
                        <input type="text" id="modal_equipo_visitante_nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="modal_goles_visitante" class="block text-sm font-medium text-gray-700">Goles Visitante</label>
                        <input type="number" name="goles_visitante" id="modal_goles_visitante" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('goles_visitante') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="modal_estado" class="block text-sm font-medium text-gray-700">Estado del Partido</label>
                        <select name="estado" id="modal_estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="programado">Programado</option>
                            <option value="finalizado">Finalizado</option>
                            <option value="suspendido">Suspendido</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" onclick="closeResultsModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Resultados
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        @push('scripts')
    {{-- Script para el Modal --}}
    <script>
        function openResultsModal(partidoId) {
            // Limpiar errores previos
            document.querySelectorAll('.text-red-500').forEach(e => e.textContent = '');

            fetch(`/admin/partidos/${partidoId}/get-details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal_partido_id').value = data.id;
                    document.getElementById('modal_equipo_local_nombre').value = data.equipo_local_nombre;
                    document.getElementById('modal_goles_local').value = data.goles_local !== null ? data.goles_local : 0; // Default a 0
                    document.getElementById('modal_equipo_visitante_nombre').value = data.equipo_visitante_nombre;
                    document.getElementById('modal_goles_visitante').value = data.goles_visitante !== null ? data.goles_visitante : 0; // Default a 0
                    document.getElementById('modal_estado').value = data.estado;

                    // Actualizar la acción del formulario
                    document.getElementById('updateResultsForm').action = `/admin/partidos/${partidoId}/update-results`;
                    document.getElementById('resultsModal').classList.remove('hidden');
                })
                .catch(error => console.error('Error al obtener detalles del partido:', error));
        }

        function closeResultsModal() {
            document.getElementById('resultsModal').classList.add('hidden');
        }

        // Manejo de errores de validación de Laravel con el modal
        @if ($errors->any() && session('partido_id_for_modal_error'))
            document.addEventListener('DOMContentLoaded', function() {
                openResultsModal({{ session('partido_id_for_modal_error') }});

                @foreach ($errors->all() as $error)
                    // Puedes mostrar los errores de una forma más específica si lo necesitas
                    // Por ejemplo, buscar el campo y añadir un span con el error
                    console.error("Error de validación: {{ $error }}");
                @endforeach

                // También puedes buscar los spans de error por su name del campo
                // Si tienes un error para 'goles_local', puedes ponerlo junto al input:
                // document.querySelector('[name="goles_local"] + .text-red-500').textContent = "Mensaje de error";
                // Esto requiere que tengas un span vacío para cada error potencial en tu HTML del modal.
            });
        @endif
    </script>
    @endpush
    
</x-app-layout>