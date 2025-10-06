<div class="sidebar w-64 bg-gray-700 text-white min-h-screen hidden md:block sidebar-transition">
    <!-- Admin Sidebar -->
    <div class="p-4 border-b border-gray-600">
        <h2 class="text-xl font-bold">Panel de Administración</h2>
    </div>
    <nav class="p-4">
        <div class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block py-2 px-3 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>

            <div class="mt-4">
                <p class="text-xs uppercase text-gray-400 mb-2">Gestión</p>
                @php
                    $managementRoutes = ['canchas.*', 'arbitros.*', 'tarjetas.*', 'torneos.*', 'equipos.*', 'jugadores.*', 'partidos.*'];
                @endphp
                <a href="{{ route('canchas.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('canchas.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-map-marked-alt mr-2"></i> Canchas
                </a>
                <a href="{{ route('arbitros.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('arbitros.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-fw fa-user-tie mr-2"></i> Árbitros
                </a>
                <a href="{{ route('tarjetas.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('tarjetas.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-square mr-2"></i> Tarjetas
                </a>
                <a href="{{ route('torneos.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('torneos.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-trophy mr-2"></i> Torneos
                </a>
                <a href="{{ route('equipos.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('equipos.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-users mr-2"></i> Equipos
                </a>
                <a href="{{ route('jugadores.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('jugadores.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-user mr-2"></i> Jugadores
                </a>

                {{-- Dropdown para Partidos --}}
                @php
                    $partidosActive = request()->routeIs(['partidos.*', 'detallePartidos.*']) ? 'bg-blue-600 text-white' : '';
                    $partidosGroupActive = request()->routeIs(['partidos.*', 'detallePartidos.*']) ? 'group-active' : ''; // Para el estado hover/active del botón
                @endphp
                <div x-data="{ open: {{ request()->routeIs(['partidos.*', 'detallePartidos.*']) ? 'true' : 'false' }} }" class="relative">
                    <button @click="open = !open"
                            class="block py-2 px-3 hover:bg-gray-600 rounded-md w-full text-left flex justify-between items-center {{ $partidosActive }}">
                        <span class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Partidos
                        </span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                         class="ml-4 mt-1 space-y-1 bg-gray-800 rounded-md py-1">
                        <a href="{{ route('partidos.index') }}"
                           class="block py-2 px-3 hover:bg-gray-600 rounded-md text-sm {{ request()->routeIs('partidos.index') ? 'bg-blue-600 text-white' : '' }}">
                            Mostrar Partidos
                        </a>
                        <a href="{{ route('detallePartidos.index') }}" 
                           class="block py-2 px-3 hover:bg-gray-600 rounded-md text-sm {{ request()->routeIs('detallePartidos.index') ? 'bg-blue-600 text-white' : '' }}">
                            Detalle de Partidos
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-xs uppercase text-gray-400 mb-2">Contenido</p>
                <a href="{{ route('noticias.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('noticias.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-newspaper mr-2"></i> Noticias
                </a>
            </div>
            <div class="mt-4">
                <p class="text-xs uppercase text-gray-400 mb-2">Gestión de Pagos</p>
                <a href="#"
                   class="block py-2 px-3 hover:bg-gray-600 rounded-md"> {{-- TODO: Crear la ruta de facturación --}}
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Facturación
                </a>
            </div>

            <div class="mt-4">
                <p class="text-xs uppercase text-gray-400 mb-2">Configuración</p>
                <a href="{{ route('usuarios.index') }}"
                   class="block py-2 px-3 rounded-md {{ request()->routeIs('usuarios.*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-600' }}">
                    <i class="fas fa-users-cog mr-2"></i> Usuarios
                </a>
                @role('Administrador')
                {{-- Dropdown para Configuración del Sistema --}}
                @php
                    $systemSettingsActive = request()->routeIs('admin.sistema.*') ? 'bg-blue-600 text-white' : '';
                @endphp
                <div x-data="{ open: {{ request()->routeIs('admin.sistema.*') ? 'true' : 'false' }} }" class="relative">
                    <button @click="open = !open"
                            class="block py-2 px-3 hover:bg-gray-600 rounded-md w-full text-left flex justify-between items-center {{ $systemSettingsActive }}">
                        <span class="flex items-center">
                            <i class="fas fa-cog mr-2"></i> Configuración
                        </span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                         class="ml-4 mt-1 space-y-1 bg-gray-800 rounded-md py-1">
                        <a href="{{ route('admin.sistema.roles.index') }}"
                           class="block py-2 px-3 hover:bg-gray-600 rounded-md text-sm {{ request()->routeIs('admin.sistema.roles.*') ? 'bg-blue-600 text-white' : '' }}">
                            Roles
                        </a>
                        <a href="{{ route('admin.sistema.permisos.index') }}"
                           class="block py-2 px-3 hover:bg-gray-600 rounded-md text-sm {{ request()->routeIs('admin.sistema.permisos.*') ? 'bg-blue-600 text-white' : '' }}">
                            Permisos
                        </a>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </nav>
</div>
