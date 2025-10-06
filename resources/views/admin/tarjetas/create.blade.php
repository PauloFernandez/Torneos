<x-app-layout>
    <div class="text-center mb-9 mt-5">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Registrar Tarjeta</h1>
    </div>

    <form action="{{ route('tarjetas.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Tarjeta</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-square text-gray-400"></i>
                    </div>
                    <input type="text" name="nombre" placeholder="Indique el nombre de la tarjeta"
                     class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('nombre') is-invalid @enderror is-valid" value="{{ old('nombre') }}">
                </div>
                @error('nombre')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="multa" class="block text-sm font-medium text-gray-700 mb-1">Consto por multa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dollar-sign text-gray-400"></i>
                    </div>
                    <input type="number" name="multa" value="{{ old('multa') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                           form-control @error('multa') is-invalid @enderror is-valid">
                </div>
                @error('multa')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Botones -->
        <div class="mt-4 flex justify-center">
            <a href="{{ route('tarjetas.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 transition duration-200">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Guardar
            </button>
        </div>
    </form>
</x-app-layout>