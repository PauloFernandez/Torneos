<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Torneos Cup') }}</title>

    <!-- Fonts -->
    <!-- Dentro del <head> de tu layout principal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- CDNS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Blade directive for head scripts/styles if needed -->
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="bg-gray-100">
        <!-- Admin Navigation -->
        @include('admin.menu')
        <div class="flex">
            <!-- Admin Sidebar -->
            @include('admin.menu-sidebar')

            <!-- Page Content -->
            <main class="flex-grow p-6">
                @include('layouts._partials.messages')

                @isset($header)
                    <header class="bg-white shadow-sm p-4 rounded-t-lg mb-4">
                        <div class="flex items-center">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <div class="bg-white rounded-lg shadow-md p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- Script para el manejo de la sidebar en móviles (si aún no lo tienes) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarToggle = document.getElementById('sidebarToggle'); // Necesitarás un botón de toggle en 'admin.menu'
            const sidebar = document.querySelector('.sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });
            }

            // Ocultar sidebar al hacer clic fuera en móvil
            document.addEventListener('click', (event) => {
                if (window.innerWidth <= 768 && sidebar.classList.contains('active') && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
