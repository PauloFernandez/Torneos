{{-- resources/views/components/confirm-modal.blade.php --}}
@props([
    'name' => 'confirm-action',
    'title' => 'Confirmar acción',
    'buttonText' => 'Eliminar',
    'buttonClass' => 'bg-red-600 hover:bg-red-700 text-white'
])

<div x-data="{ show: false, formToSubmit: null }"
     x-on:open-confirm-modal.window="
        if ($event.detail.name === '{{ $name }}') {
            show = true;
            formToSubmit = $event.detail.form;
        }
     "
     x-on:close-confirm-modal.window="
        if ($event.detail === '{{ $name }}') {
            show = false;
            formToSubmit = null;
        }
     "
     x-show="show"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="show = false; formToSubmit = null"
         @keydown.escape="show = false; formToSubmit = null"
         class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        
        <div class="p-6">
            <!-- Icono de advertencia -->
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z">
                    </path>
                </svg>
            </div>
            
            <!-- Título -->
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">
                {{ $title }}
            </h3>
            
            <!-- Contenido personalizable -->
            <div class="text-gray-600 text-center mb-6">
                {{ $slot }}
            </div>
            
            <!-- Botones -->
            <div class="flex space-x-3 justify-end">
                <button type="button" 
                        @click="show = false; formToSubmit = null"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    Cancelar
                </button>
                
                <button type="button" 
                        @click="if(formToSubmit) { formToSubmit.submit(); }"
                        class="px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-opacity-50 {{ $buttonClass }}">
                    {{ $buttonText }}
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Función helper para usar en formularios --}}
<script>
function confirmAction(formElement, modalName = 'confirm-action') {
    window.dispatchEvent(new CustomEvent('open-confirm-modal', {
        detail: { 
            name: modalName,
            form: formElement 
        }
    }));
}
</script>

{{-- 
INSTRUCCIONES DE USO:

1. Incluye el componente en tu layout o vista:
   <x-confirm-modal />

2. En tus formularios, cambia:
   onsubmit="return confirm('mensaje')"
   
   Por:
   onsubmit="event.preventDefault(); confirmAction(this)"

3. Personaliza el contenido con slot:
   <x-confirm-modal name="delete-player" title="Eliminar Jugador" buttonText="Eliminar">
       ¿Estás seguro de remover a <strong>Juan Pérez</strong> del equipo?
   </x-confirm-modal>

EJEMPLOS DE IMPLEMENTACIÓN:
--}}

{{-- Ejemplo 1: Para la vista de jugadores --}}
{{-- 
<x-confirm-modal name="remove-player" title="Remover Jugador" buttonText="Remover">
    ¿Estás seguro de remover este jugador del equipo?<br>
    <small class="text-gray-500">Esta acción no se puede deshacer.</small>
</x-confirm-modal>

En el formulario:
<form action="{{ route('jugadores.destroy', [$jugador, $equipo]) }}" 
      method="post" 
      onsubmit="event.preventDefault(); confirmAction(this, 'remove-player')">
    @csrf
    @method('delete')
    <button class="text-red-600 hover:text-red-900">
        <i class="fas fa-trash"></i> Remover
    </button>
</form>
--}}

{{-- Ejemplo 2: Para la vista de equipos --}}
{{-- 
<x-confirm-modal name="delete-team" title="Eliminar Equipo" buttonText="Eliminar" 
                 buttonClass="bg-red-600 hover:bg-red-700 text-white focus:ring-red-500">
    ¿Estás seguro de eliminar este equipo?<br>
    <small class="text-gray-500">Se perderán todos los datos asociados.</small>
</x-confirm-modal>

En el formulario:
<form action="{{ route('equipos.destroy', $equipo) }" 
      method="post"
      onsubmit="event.preventDefault(); confirmAction(this, 'delete-team')">
    @csrf
    @method('delete')
    <button class="text-red-600 hover:text-red-900">Eliminar</button>
</form>
--}}