<header class="glassmorphism sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo / Título del Torneo -->
            <x-application-logo class="h-12 md:h-16 fill-current text-gray-300" />
            
            <!-- Botón Hamburguesa (visible solo en móvil) -->
            <button id="menuToggle" class="md:hidden text-gray-300 hover:text-white focus:outline-none">
                <svg id="menuIcon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="closeIcon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Menú de Navegación Principal (Desktop) -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('participantes.clasificaciones') }}"
                    class="hover:text-white font-semibold transition-colors 
                    {{ request()->routeIs('participantes.clasificaciones') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                     {{ __('CLASIFICACIONES') }}</a>
                <a href="{{ route('participantes.equipos') }}"
                    class="text-gray-300 hover:text-white font-semibold transition-colors
                    {{ request()->routeIs('participantes.equipos') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                    {{ __('EQUIPO') }}</a>
                <a href="{{ route('participantes.goleadores') }}"
                    class="text-gray-300 hover:text-white font-semibold transition-colors
                    {{ request()->routeIs('participantes.goleadores') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                    {{ __('GOLEADORES') }}</a>
                <a href="{{ route('participantes.asistencias') }}"
                    class="text-gray-300 hover:text-white font-semibold transition-colors
                    {{ request()->routeIs('participantes.asistencias') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                    {{ __('ASISTENCIAS') }}</a>
                <a href="{{ route('participantes.partidos') }}"
                    class="text-gray-300 hover:text-white font-semibold transition-colors
                    {{ request()->routeIs('participantes.partidos') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                    {{ __('PARTIDOS') }}</a>
                <a href="{{ route('participantes.noticias') }}" 
                    class="text-gray-300 hover:text-white font-semibold transition-colors
                    {{ request()->routeIs('participantes.noticias') ? 'text-white font-bold border-b-2 border-purple-400 pb-1' : 'text-gray-300' }}">
                    {{ __('NOTICIAS') }}</a>
            </nav>

            <!-- Perfil de Usuario (Desktop) -->
            <div class="hidden md:block relative group">
                <button class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/40?u=player1" alt="Avatar de usuario"
                        class="w-10 h-10 rounded-full border-2 border-purple-400">
                    <div class="hidden sm:flex flex-col items-start">
                        <span class="font-bold text-white">{{ Auth::user()->name }}</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-transform duration-300 group-hover:rotate-180"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="glassmorphism absolute top-full right-0 mt-2 w-48 rounded-lg shadow-xl overflow-hidden
                            opacity-0 invisible group-hover:opacity-100 group-hover:visible
                            transform scale-95 group-hover:scale-100 transition-all duration-200 ease-out">
                    <a href="{{ route('participantes.perfil.edit') }}" class="block px-4 py-3 text-sm text-gray-200 hover:bg-purple-600/50">Mi Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-4 py-3 text-sm text-red-400 hover:bg-red-600/50">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menú Mobile (desplegable) -->
        <nav id="mobileMenu" class="md:hidden hidden mt-4 pb-4 space-y-3">
            <a href="{{ route('participantes.clasificaciones') }}"
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors 
                {{ request()->routeIs('participantes.clasificaciones') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('CLASIFICACIONES') }}</a>
            <a href="{{ route('participantes.equipos') }}"
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors
                {{ request()->routeIs('participantes.equipos') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('EQUIPO') }}</a>
            <a href="{{ route('participantes.goleadores') }}"
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors
                {{ request()->routeIs('participantes.goleadores') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('GOLEADORES') }}</a>
            <a href="{{ route('participantes.asistencias') }}"
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors
                {{ request()->routeIs('participantes.asistencias') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('ASISTENCIAS') }}</a>
            <a href="{{ route('participantes.partidos') }}"
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors
                {{ request()->routeIs('participantes.partidos') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('PARTIDOS') }}</a>
            <a href="{{ route('participantes.noticias') }}" 
                class="block py-2 px-4 rounded-lg hover:bg-purple-600/30 font-semibold transition-colors
                {{ request()->routeIs('participantes.noticias') ? 'bg-purple-600/50 text-white' : 'text-gray-300' }}">
                {{ __('NOTICIAS') }}</a>
            
            <!-- Perfil en Mobile -->
            <div class="border-t border-gray-700 pt-3 mt-3">
                <div class="flex items-center gap-3 px-4 py-2">
                    <img src="https://i.pravatar.cc/40?u=player1" alt="Avatar de usuario"
                        class="w-10 h-10 rounded-full border-2 border-purple-400">
                    <span class="font-bold text-white">{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('participantes.perfil.edit') }}" 
                   class="block py-2 px-4 text-gray-200 hover:bg-purple-600/30 rounded-lg transition-colors">
                    Mi Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 text-red-400 hover:bg-red-600/30 rounded-lg transition-colors">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>
    </div>
</header>

<script>
    // Toggle del menú móvil
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>