<x-app-layout>
    <div class="text-center mb-9 mt-5">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Actualizar Noticia</h1>
    </div>

    <form action="{{ route('noticias.update', $noticia ) }}" method="POST" class="space-y-4">
        @method('PUT')
        @csrf
        <!-- Información básica -->
        <div class="grid grid-cols-2 gap-4">
            <input type="hidden" name="autor_id" value="{{ Auth::user()->id }}">
            <div>
                <label for="Titulo" class="block text-sm font-medium text-gray-700 mb-1">Titulo</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-heading text-gray-400"></i>
                    </div>
                    <input type="text" name="titulo" placeholder="Indique el titulo de la Noticia"
                     class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                        form-control @error('titulo') is-invalid @enderror is-valid" value="{{ $noticia->titulo }}">
                </div>
                @error('titulo')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="fecha_publicado" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Publicación</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" name="fecha_publicado" value="{{ $noticia->fecha_publicado->format('Y-m-d') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                           form-control @error('fecha_publicado') is-invalid @enderror is-valid">
                </div>
                @error('fecha_publicado')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>
                <div>
                    <textarea name="descripcion" rows="6" cols="70" maxlength="700"
                    class="block w-full pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                        form-control @error('name') is-invalid @enderror is-valid" value="{{ $noticia->descripcion }}"> {{ $noticia->descripcion }}
                    </textarea>
                </div>
                @error('name')
                    <span class="invalid-feedback text-red-600">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <a href="{{ route('noticias.index') }}"
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