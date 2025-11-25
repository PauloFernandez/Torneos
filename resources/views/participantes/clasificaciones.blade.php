@extends('layouts.participantes')
@section('title', 'Clasificaciones')
@section('content')
    <header class="text-center mb-12 fade-in">
        <h1 class="text-5xl font-black uppercase tracking-wider neon-text-purple">Tabla de Posiciones</h1>
    </header>
    <main class="max-w-5xl mx-auto glassmorphism rounded-xl shadow-lg overflow-hidden fade-in" style="animation-delay: 0.2s;">
        <table class="w-full text-left">
                <!-- Encabezado de la tabla -->
                <thead class="bg-black/30 text-gray-300 uppercase text-sm tracking-wider">
                    <tr>
                        <th class="p-4">Pos</th>
                        <th class="p-4">Equipo</th>
                        <th class="p-4 text-center">PJ</th>
                        <th class="p-4 text-center">G</th>
                        <th class="p-4 text-center">E</th>
                        <th class="p-4 text-center">P</th>
                        <th class="p-4 text-center">SG</th>
                        <th class="p-4 text-center font-bold">Pts</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    <tr class="hover:bg-purple-600/30 transition-colors duration-200">
                    @forelse ($torneos as $torneo)
                        @foreach ($torneo->equipos as $index => $equipo)
                            <tr>
                                <td class="p-4 font-bold text-xl">
                                    @if($index == 0)
                                        <span class="text-yellow-400">🥇</span>
                                    @elseif($index == 1)
                                        <span class="text-gray-300">🥈</span>
                                    @elseif($index == 2)
                                        <span class="text-orange-400">🥉</span>
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </td>

                                <td class="p-4 flex items-center gap-3">
                                    {{-- Logo --}}
                                    <img src="{{ asset('img/' . $equipo->file_uri) }}" alt="Logo" class="h-6 w-6">
                                    <span class="font-semibold">{{ $equipo->nombre }}</span>
                                </td>

                                <td class="p-4 text-center">{{ $equipo->PJ}}</td>
                                <td class="p-4 text-center">{{ $equipo->G }}</td>
                                <td class="p-4 text-center">{{ $equipo->E }}</td>
                                <td class="p-4 text-center">{{ $equipo->P }}</td>
                                <td class="p-4 text-center">{{ $equipo->DG }}</td>
                                <td class="p-4 text-center font-bold text-xl text-white">{{ $equipo->Pts }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8"
                                class="px-4 py-6 whitespace-nowrap text-sm font-medium text-center">
                                No se encontraron datos
                            </td>
                        </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
    </main>
@endsection