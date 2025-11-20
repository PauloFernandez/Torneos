@extends('layouts.participantes')
@section('title', 'Noticias')
@section('content')
<header class="text-center mb-12 fade-in">
    <h1 class="text-5xl font-black uppercase tracking-wider neon-text-purple">Noticias</h1>
    <p class="text-gray-400 mt-4 text-lg">Mantente informado con las últimas actualizaciones</p>
</header>

<main class="max-w-6xl mx-auto px-4 fade-in" style="animation-delay: 0.2s;">
    @forelse ($noticias as $noticia)
        <article class="glassmorphism rounded-xl shadow-lg overflow-hidden mb-6 hover:shadow-purple-500/20 hover:shadow-2xl transition-all duration-300 group">
            <div class="p-6">
                <!-- Fecha destacada -->
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-purple-600/20 text-purple-300 text-sm font-semibold border border-purple-500/30">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $noticia->fecha_publicado->format('d/m/Y') }}
                    </span>
                    
                    <!-- Badge de "nuevo" si la noticia tiene menos de 7 días -->
                    @if($noticia->fecha_publicado->diffInDays(now()) < 7)
                        <span class="px-3 py-1 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs font-bold uppercase animate-pulse">
                            Nuevo
                        </span>
                    @endif
                </div>

                <!-- Título -->
                <h2 class="text-2xl font-bold text-white mb-3 group-hover:text-purple-300 transition-colors duration-200">
                    {{ $noticia->titulo }}
                </h2>

                <!-- Descripción -->
                <p class="text-gray-300 leading-relaxed">
                    {{ $noticia->descripcion }}
                </p>

                <!-- Línea decorativa -->
                <div class="mt-4 h-1 w-0 group-hover:w-full bg-gradient-to-r from-purple-600 to-pink-600 transition-all duration-500 rounded-full"></div>
            </div>
        </article>
    @empty
        <!-- Estado vacío mejorado -->
        <div class="glassmorphism rounded-xl shadow-lg p-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-600/20 mb-6">
                <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">No hay noticias disponibles</h3>
            <p class="text-gray-400">Vuelve pronto para ver las últimas actualizaciones</p>
        </div>
    @endforelse

    <!-- Paginación si es necesario -->
    @if(method_exists($noticias, 'links'))
        <div class="mt-8">
            {{ $noticias->links() }}
        </div>
    @endif
</main>
@endsection