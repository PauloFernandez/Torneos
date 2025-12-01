<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de torneos oficiales de AUF 2025. Compite en ligas y copas, gana premios y demuestra que eres el mejor jugador.">
    <meta name="keywords" content="Torneos Cup, torneos, fútbol 5, fútbol Masculino, fútbol Femenino, fútbol Adolecentes, fútbol amateur">
    <meta name="author" content="Torneos Cup">
    <title>Torneos Cup</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-green-900 via-green-800 to-green-900 py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="{{ asset('img/logos/logoTorneo.png') }}" alt="background" class="w-full h-full object-cover">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h1 class="text-5xl font-bold mb-4">
                REGISTRO DE <span class="text-cyan-400">EQUIPOS</span>
            </h1>
            <p class="text-xl text-gray-200 mb-8">
                Únete a la competencia más emocionante de la temporada
            </p>
        </div>
    </div>
</section>

<!-- Proceso de Registro -->
<section class="bg-gray-900 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Título -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">
                    ¿CÓMO <span class="text-cyan-400">REGISTRARSE?</span>
                </h2>
                <p class="text-gray-400 text-lg">
                    Sigue estos simples pasos para inscribir a tu equipo
                </p>
            </div>

            <!-- Pasos del Proceso -->
            <div class="grid md:grid-cols-4 gap-6 mb-16">
                <!-- Paso 1 -->
                <div class="bg-gray-800 rounded-lg p-6 text-center border-t-4 border-cyan-400 hover:transform hover:scale-105 transition-all">
                    <div class="bg-cyan-400 text-gray-900 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Descarga</h3>
                    <p class="text-gray-400 text-sm">
                        Descarga la plantilla Excel
                    </p>
                </div>

                <!-- Paso 2 -->
                <div class="bg-gray-800 rounded-lg p-6 text-center border-t-4 border-cyan-400 hover:transform hover:scale-105 transition-all">
                    <div class="bg-cyan-400 text-gray-900 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Completa</h3>
                    <p class="text-gray-400 text-sm">
                        Rellena todos los datos solisitados con la infirmacion del tus jugadores 
                    </p>
                </div>

                <!-- Paso 3 -->
                <div class="bg-gray-800 rounded-lg p-6 text-center border-t-4 border-cyan-400 hover:transform hover:scale-105 transition-all">
                    <div class="bg-cyan-400 text-gray-900 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Envía</h3>
                    <p class="text-gray-400 text-sm">
                        Envía por email a nuestra casilla oficial el archivo e indica a que torneos deseas participar 
                    </p>
                </div>

                <!-- Paso 4 -->
                <div class="bg-gray-800 rounded-lg p-6 text-center border-t-4 border-cyan-400 hover:transform hover:scale-105 transition-all">
                    <div class="bg-cyan-400 text-gray-900 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        4
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Confirmación</h3>
                    <p class="text-gray-400 text-sm">
                        Recibe la confirmación de tu inscripción
                    </p>
                </div>
            </div>

            <!-- Instrucciones Detalladas -->
            <div class="bg-gray-800 rounded-lg p-8 mb-12">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-8 h-8 text-cyan-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Instrucciones Detalladas
                </h3>

                <div class="space-y-6">
                    <!-- Descarga -->
                    <div class="flex items-start">
                        <div class="bg-cyan-400 text-gray-900 w-8 h-8 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0 mt-1">
                            1
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-2">Descarga la Plantilla Excel</h4>
                            <p class="text-gray-400 mb-4">
                                Haz clic en el botón de descarga para obtener la plantilla oficial. El archivo contiene todos los campos necesarios para el registro de tus jugadores.
                            </p>
                            <a href="{{ route('export') }}" class="inline-flex items-center bg-cyan-400 hover:bg-cyan-500 text-gray-900 font-bold py-3 px-6 rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Descargar Plantilla Excel
                            </a>
                        </div>
                    </div>

                    <!-- Línea divisoria -->
                    <div class="border-t border-gray-700"></div>

                    <!-- Completa los datos -->
                    <div class="flex items-start">
                        <div class="bg-cyan-400 text-gray-900 w-8 h-8 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0 mt-1">
                            2
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-2">Completa los Datos Requeridos</h4>
                            <p class="text-gray-400 mb-3">
                                Rellena cuidadosamente todos los campos del archivo Excel con la información de tu jugadores:
                            </p>
                            <ul class="text-gray-400 space-y-2 ml-4">
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">•</span>
                                    <span><strong class="text-white">Datos de Jugadores:</strong> CI/Pasaporte, Nombre, Apellido, fecha de nacimiento, direccion, telefono, correo electronico, posición y numero de camiseta</span>
                                </li>
                            </ul>
                            <div class="bg-yellow-900 bg-opacity-30 border-l-4 border-yellow-500 p-4 mt-4">
                                <p class="text-yellow-300 text-sm">
                                    <strong>⚠️ Importante:</strong> Verifica que todos los datos sean correctos. Información incorrecta puede retrasar tu inscripción.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Línea divisoria -->
                    <div class="border-t border-gray-700"></div>

                    <!-- Envío -->
                    <div class="flex items-start">
                        <div class="bg-cyan-400 text-gray-900 w-8 h-8 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0 mt-1">
                            3
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-2">Envía tu archivo</h4>
                            <p class="text-gray-400 mb-3">
                                Una vez completada la plantilla, envía el archivo por correo electrónico a:
                            </p>
                            <div class="bg-gray-700 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-400 text-sm mb-1">Email oficial de inscripciones:</p>
                                        <p class="text-cyan-400 text-xl font-bold">inscripciones@torneoscup.com</p>
                                    </div>
                                    <button onclick="copyEmail()" class="bg-cyan-400 hover:bg-cyan-500 text-gray-900 px-4 py-2 rounded-lg font-bold transition-colors text-sm">
                                        Copiar Email
                                    </button>
                                </div>
                            </div>
                            
                            <p class="text-gray-400 mb-3">
                                <strong class="text-white">Asunto del correo:</strong> Inscripción - [Nombre del Equipo]
                            </p>
                            
                            <p class="text-gray-400 mb-2">
                                <strong class="text-white">En el cuerpo del email, incluye:</strong>
                            </p>
                            <ul class="text-gray-400 space-y-2 ml-4 mb-4">
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">•</span>
                                    <span>Nombre completo del equipo</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">•</span>
                                    <span>Torneo al que deseas inscribirte</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">•</span>
                                    <span>Datos de contacto del representante del equipo</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">•</span>
                                    <span>Confirmación de haber leído y aceptado el reglamento del torneo</span>
                                </li>
                            </ul>

                            <div class="bg-gray-700 rounded-lg p-4 border-l-4 border-cyan-400">
                                <p class="text-white font-bold mb-2">📧 Ejemplo de email:</p>
                                <p class="text-gray-400 text-sm font-mono">
                                    <strong>Asunto:</strong> Inscripción - Club Deportivo Unidos<br><br>
                                    <strong>Cuerpo:</strong><br>
                                    Nombre del Equipo: Club Deportivo Unidos<br>
                                    Torneo: Premier League<br>
                                    Representante: Juan Pérez<br>
                                    Teléfono: +54 11 1234-5678<br>
                                    Email: jperez@email.com<br><br>
                                    Confirmamos haber leído y aceptado el reglamento oficial del torneo.<br><br>
                                    Adjunto: Inscripcion.xlsx
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Línea divisoria -->
                    <div class="border-t border-gray-700"></div>

                    <!-- Confirmación -->
                    <div class="flex items-start">
                        <div class="bg-cyan-400 text-gray-900 w-8 h-8 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0 mt-1">
                            4
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-2">Espera la Confirmación</h4>
                            <p class="text-gray-400 mb-3">
                                Nuestro equipo revisará tu solicitud y te enviará un correo de confirmación dentro de las próximas 48-72 horas hábiles.
                            </p>
                            <p class="text-gray-400">
                                En el email de confirmación recibirás:
                            </p>
                            <ul class="text-gray-400 space-y-2 ml-4 mt-2">
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">✓</span>
                                    <span>Número de inscripción de tu equipo</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">✓</span>
                                    <span>Instrucciones de pago (si aplica)</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-400 mr-2">✓</span>
                                    <span>Fecha de inicio del torneo</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Importante -->
            <div class="bg-gradient-to-r from-cyan-900 to-cyan-800 rounded-lg p-8 mb-12">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-8 h-8 text-cyan-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Información Importante
                </h3>
                <div class="grid md:grid-cols-2 gap-6 text-white">
                    <div>
                        <h4 class="font-bold mb-2 text-lg">📋 Requisitos Previos</h4>
                        <ul class="text-gray-200 space-y-1 text-sm">
                            <li>• Haber leído el reglamento completo del torneo</li>
                            <li>• Todos los jugadores deben ser mayores de edad (o contar con autorización)</li>
                            <li>• Documentación en regla de todos los participantes</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-2 text-lg">⏰ Plazos</h4>
                        <ul class="text-gray-200 space-y-1 text-sm">
                            <li>• Las inscripciones cierran 15 días antes del torneo</li>
                            <li>• Confirmación en 48-72 horas hábiles</li>
                            <li>• Modificaciones permitidas hasta 7 días antes</li>
                            <li>• Pago de inscripción dentro de los 5 días de confirmación</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Contacto de Soporte -->
<section class="bg-gray-950 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-white mb-4">¿Necesitas Ayuda?</h3>
            <p class="text-gray-400 mb-6">
                Si tienes dudas sobre el proceso de inscripción, contáctanos y te ayudaremos.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="mailto:inscripciones@torneoscup.com" class="inline-flex items-center justify-center bg-cyan-400 hover:bg-cyan-500 text-gray-900 font-bold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Enviar Email
                </a>
                <a href="https://wa.me/5491112345678" target="_blank" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function copyEmail() {
    const email = 'inscripciones@torneoscup.com';
    navigator.clipboard.writeText(email).then(function() {
        alert('Email copiado al portapapeles: ' + email);
    }, function(err) {
        console.error('Error al copiar: ', err);
    });
}
</script>

</html>
</body>

</html>