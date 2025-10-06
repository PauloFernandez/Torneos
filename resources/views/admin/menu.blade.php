<nav class="bg-gray-800 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Botón para togglear Sidebar en móviles -->
            <button id="sidebarToggle" class="text-white focus:outline-none md:hidden p-2 rounded-md hover:bg-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div class="flex items-center">
                <x-application-logo class="h-16 fill-current text-gray-300" /> {{-- Color ajustado para contraste --}}
                <span class="text-xl font-bold ml-2">Torneos Cup</span>
            </div>
        </div>

        <!-- Perfil de Usuario -->
        <div class="relative" x-data="{ open: false }"> {{-- Usando Alpine.js para el dropdown del perfil --}}
            <button @click="open = !open"
                    class="flex items-center gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full p-1 pr-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=FFFFFF&background=5C6BC0" {{-- Avatar dinámico --}}
                     alt="Avatar de usuario"
                     class="w-10 h-10 rounded-full border-2 border-purple-400 object-cover">
                <div class="hidden sm:flex flex-col items-start">
                    <span class="font-bold text-white text-sm">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-400">{{ Auth::user()->email }}</span> {{-- Mostrar email si es relevante --}}
                </div>
                <!-- Icono de flecha para el desplegable -->
                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
            <!-- Menú Desplegable -->
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 class="glassmorphism absolute top-full right-0 mt-2 w-48 rounded-lg shadow-xl overflow-hidden z-50 origin-top-right">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-dropdown-link>
                <div class="border-t border-gray-700"></div> {{-- Ajustado el color del borde --}}
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </div>
</nav>