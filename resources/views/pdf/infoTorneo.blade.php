<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reglamento - {{ $torneo->nombre }}</title>
    <style>
        @page {
            margin: 20mm 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: #ffffff;
        }

        /* Header con logo */
        .header {
            text-align: center;
            padding: 30px 0 25px 0;
            border-bottom: 4px solid #3498db;
            margin-bottom: 35px;
        }

        .logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px auto;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .header .subtitle {
            color: #7f8c8d;
            font-size: 15px;
            font-style: italic;
        }

        /* Información principal del torneo - VERSIÓN COMPATIBLE */
        .torneo-info {
            background: #667eea; /* Color sólido en lugar de gradiente */
            color: white;
            padding: 25px 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
            border: 3px solid #5568d3;
        }

        .torneo-info h2 {
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: bold;
            color: white;
        }

        .torneo-info .categoria {
            display: inline-block;
            background: white;
            color: #667eea;
            padding: 8px 25px;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 600;
        }

        /* Tabla de fechas */
        .fechas-table {
            width: 100%;
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid #e0e0e0;
        }

        .fechas-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .fechas-table th {
            background: #34495e;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
        }

        .fechas-table td {
            padding: 12px 15px;
            font-size: 15px;
            color: #2c3e50;
            font-weight: 500;
            border-bottom: 1px solid #e0e0e0;
        }

        .fechas-table tr:last-child td {
            border-bottom: none;
        }

        /* Grid de costos */
        .costos-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .costo-row {
            display: table-row;
        }

        .costo-cell {
            display: table-cell;
            padding: 15px 20px;
            border-bottom: 1px solid #ecf0f1;
            vertical-align: middle;
        }

        .costo-cell:nth-child(odd) {
            background: #f8f9fa;
            width: 50%;
            font-weight: 600;
            color: #34495e;
            font-size: 14px;
        }

        .costo-cell:nth-child(even) {
            font-size: 18px;
            font-weight: bold;
        }

        .precio-inscripcion {
            color: #27ae60;
        }

        .precio-cancha {
            color: #3498db;
        }

        .precio-premio {
            color: #e74c3c;
        }

        /* Sección de reglas */
        .seccion-reglas {
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .seccion-reglas > h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 3px solid #3498db;
            font-weight: bold;
        }

        .regla-card {
            background: #ffffff;
            border-left: 4px solid #3498db;
            border-radius: 6px;
            padding: 20px 25px;
            margin-bottom: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            page-break-inside: avoid;
        }

        .regla-card h3 {
            color: #2c3e50;
            font-size: 17px;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .regla-card h3:before {
            content: "> ";
            color: #3498db;
            font-weight: bold;
            margin-right: 5px;
            font-size: 20px;
        }

        .regla-card p {
            color: #34495e;
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #bdc3c7;
            text-align: center;
            font-size: 11px;
            color: #7f8c8d;
        }

        .footer p {
            margin: 3px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img class="logo" src="{{ public_path('img/logos/logoTorneo.png') }}" alt="Logo Torneo">
        <h1>Reglamento Oficial</h1>
        <p class="subtitle">Información y normativas del torneo</p>
    </div>

    <!-- Información del Torneo - MEJORADO -->
    <div class="torneo-info">
        <h2>{{ $torneo->nombre }}</h2>
        <span class="categoria">Categoría: {{ $torneo->categoria }}</span>
    </div>

    <!-- Tabla de Fechas y Equipos -->
    <div class="fechas-table">
        <table>
            <thead>
                <tr>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalización</th>
                    <th>Equipos Participantes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $torneo->fecha_inicio->format('d/m/Y') }}</td>
                    <td>{{ $torneo->fecha_fin->format('d/m/Y') }}</td>
                    <td>{{ $torneo->cantidad_equipos }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Costos y Premios -->
    <div class="costos-grid">
        <div class="costo-row">
            <div class="costo-cell">Valor de Inscripción</div>
            <div class="costo-cell precio-inscripcion">$ {{ number_format($torneo->inscripcion, 2) }}</div>
        </div>
        <div class="costo-row">
            <div class="costo-cell">Valor Cancha por Partido</div>
            <div class="costo-cell precio-cancha">$ {{ number_format($torneo->valor_cancha, 2) }}</div>
        </div>
        <div class="costo-row">
            <div class="costo-cell">Premio Principal</div>
            <div class="costo-cell precio-premio">$ {{ number_format($torneo->premio, 2) }}</div>
        </div>
        @if($torneo->premio_extra)
        <div class="costo-row">
            <div class="costo-cell">Premio Extra</div>
            <div class="costo-cell">{{ $torneo->premio_extra }}</div>
        </div>
        @endif
    </div>

    <!-- Reglas y Regulaciones -->
    <div class="seccion-reglas">
        <h2>Reglas y Regulaciones</h2>

        <div class="regla-card">
            <h3>Reglas Generales</h3>
            <p>{{ $torneo->reglas_gral }}</p>
        </div>

        <div class="regla-card">
            <h3>Sistema de Competición</h3>
            <p>{{ $torneo->sis_competicion }}</p>
        </div>

        <div class="regla-card">
            <h3>Requisitos para Jugadores</h3>
            <p>{{ $torneo->requisito_jugador }}</p>
        </div>

        <div class="regla-card">
            <h3>Conducta y Disciplina</h3>
            <p>{{ $torneo->disciplina }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Documento generado el {{ now()->format('d/m/Y - H:i') }} hs</strong></p>
        <p>{{ $torneo->nombre }} - Reglamento Oficial {{ date('Y') }}</p>
    </div>
</body>

</html>