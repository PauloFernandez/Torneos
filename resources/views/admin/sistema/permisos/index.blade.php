<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Roles y Permisos</h1>
    </x-slot>

		<div class="mb-6">
    	<div class="border-b border-gray-200">
      	<nav class="-mb-px flex space-x-8">
        	<a href="{{ route('admin.sistema.roles.index') }}"
          		class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-4 py-3 text-sm font-medium">Roles</a>
          <button class="border-b-2 border-blue-500 text-blue-600 px-4 py-3 text-sm font-medium">Permisos</button>
      	</nav>
     	</div>
     </div>
                
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Permisos</h2>
        <button id="addPermissionBtn"
           			class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 -mt-1 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Nuevo Permiso
         </button>
    </div>

    <x-responsive-table>
        <x-slot name="head">  
        	<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>                          
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuarios</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </x-slot>
        <x-slot name="body">
            @forelse ($permisos as $permiso)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $permiso->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{$permiso->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
		              <div class="flex items-center">
				            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
				               <i class="fas fa-user"></i>
				            </div>
		                <div class="ml-4">
		                	<div class="text-sm font-medium text-gray-900">{{ $permiso->roles_count }}</div>
		                </div>
		              </div>
                </td>
                
                <!-- Botones -->
                <td class="px-4 py-6 whitespace-nowrap text-sm font-medium flex">
		              <a href="{{ route('admin.sistema.permisos.edit', $permiso) }}" class="text-blue-600 hover:text-blue-900 mr-3">
		              	 <i class="fas fa-edit"></i> Editar
		             	</a>

                  <form action="{{ route('admin.sistema.permisos.destroy', $permiso)  }}" method="post"
                        onsubmit="event.preventDefault(); confirmAction(this, 'delete-permiso')">
                        @csrf
                        @method('delete')
                        <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Eliminar
                        </button>
                  </form> 
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center text-gray-500">No hay datos ingresados</td>
                </tr>
            @endforelse
        </x-slot>
            {{-- Si usas paginación de Laravel --}}
            @if ($permisos->hasPages())
                <x-slot name="pagination">
                    {{ $permisos->links() }}
                </x-slot>
            @endif
            
    </x-responsive-table>

    <x-confirm-modal name="delete-permiso" title="Eliminar permiso" buttonText="Eliminar">
        ¿Estás seguro de eliminar este permiso?<br>
        <small class="text-gray-500 mt-1 block">Esta acción no se puede deshacer.</small>
    </x-confirm-modal>

    <!-- Add Permission Modal -->
    <div id="addPermissionModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full modal-animation">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Crear Nuevo Permiso</h3>
                    <button id="closePermissionModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.sistema.permisos.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del
                            Permiso</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Ej: crear">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelPermissionBtn"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Permiso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
@push('scripts')
    @vite(['resources/js/pages/roles.js'])
@endpush
</x-app-layout>