<x-app-layout>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard de Administración</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach ($data as $item)
                <div class="bg-blue-100 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-800">Equipos registrados</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $item->equipos }}</p>
                    </div>
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-green-100 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-green-800">Jugadores registrados</p>
                        <p class="text-2xl font-bold text-green-900">{{ $item->jugadores }}</p>
                    </div>
                    <i class="fas fa-user text-green-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-yellow-100 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-yellow-800">Partidos jugados</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $item->jugados }}</p>
                    </div>
                    <i class="fas fa-calendar-alt text-yellow-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-purple-100 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-purple-800">Torneos Creados</p>
                        <p class="text-2xl font-bold text-purple-900">{{ $item->torneos }}</p>
                    </div>
                    <i class="fas fa-trophy text-purple-600 text-2xl"></i>
                </div>
            </div>
            @endforeach 
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Agregar Nuevo</h3>
                <div class="space-y-2">
                    <a href="{{ route('torneos.create') }}" class="block py-2 px-3 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100">
                        <i class="fas fa-plus-circle mr-2"></i> Nuevo Torneo
                    </a>
                    <a href="{{ route('equipos.create') }}" class="block py-2 px-3 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100">
                        <i class="fas fa-plus-circle mr-2"></i> Nuevo Equipo
                    </a>
                    <a href="{{ route('jugadores.create') }}" class="block py-2 px-3 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100">
                        <i class="fas fa-plus-circle mr-2"></i> Asignar Jugador
                    </a>
                    <a href="{{ route('partidos.create') }}" class="block py-2 px-3 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100">
                        <i class="fas fa-plus-circle mr-2"></i> Nuevo Partido
                    </a>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Reportes</h3>
                <div class="space-y-2">
                    <a href="{{ route('clasificaciones.export') }}" class="block py-2 px-3 bg-green-50 text-green-700 rounded-md hover:bg-green-100">
                        <i class="fas fa-file-alt mr-2"></i> Reporte de Clasificación
                    </a>
                    <a href="{{ route('golAsist.export') }}" class="block py-2 px-3 bg-green-50 text-green-700 rounded-md hover:bg-green-100">
                        <i class="fas fa-file-alt mr-2"></i> Reporte de Jugadores
                    </a>
                    <a href="{{ route('equipos.export') }}" class="block py-2 px-3 bg-green-50 text-green-700 rounded-md hover:bg-green-100">
                        <i class="fas fa-file-alt mr-2"></i> Reporte de Equipos
                    </a>
                </div>
            </div>
        </div>
</x-app-layout>
