<p align="center">
  <img src="public/img/Torneo_Futbol.png" alt="Logo">
</p>
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Torneos App

**Torneos App** es una aplicación web diseñada para gestionar torneos de fútbol en diversas categorías. Permite a los administradores crear y gestionar torneos, equipos, jugadores, árbitros, canchas, partidos, reportes de resultados.

## Funcionalidades

- **Autenticacion**: Permite ingresar a la aplicacion mediante diferentes roles y permisos.
- **Creación de Torneos**: Permite la creación de torneos con diversas categorías.
- **Gestión de Equipos**: Gestión completa de los equipos participantes.
- **Gestión de Jugadores**: Registro y administración de los jugadores en cada equipo.
- **Gestión de Árbitros**: Administración de árbitros asignados a cada partido.
- **Gestión de Canchas**: Asignación y gestión de las canchas disponibles para los partidos.
- **Creación y Gestión de Partidos**: Agregar y gestionar los partidos programados.
- **Reportes de Partidos Jugados**: Visualización de resultados y estadísticas de los partidos.


## Gran Torneo de Fútbol

En la página principal de la aplicación se destacan los diferentes torneos que se pueden crear, permitiendo que toda la comunidad futbolera participe. Cada torneo tiene su propia página donde se pueden consultar las reglas, que están disponibles para descarga en formato PDF.

El administrador puede elegir si desea mostrar las reglas del torneo en la página principal, y estas se cargan automáticamente al momento de crear el torneo.

## Usuarios

### Usuario Invitado (Jugador)

El usuario invitado o "Jugador" tiene acceso limitado a la aplicación. Podrá navegar y visualizar la siguiente información:

- Noticias generales
- Detalles sobre equipos y jugadores (tabla de goleadores y asistencias)
- Detalles de partidos "Jugados, Suspendidos, Finalizado, etc"
- Visualizar la información torneo

### Usuario Administrador

El **Admin** es el usuario con permisos completos para gestionar todos los aspectos de la aplicación. Algunas de las tareas que puede realizar incluyen:

- **Crear torneos** y establecer los valores de inscripción
- **Crear y asignar equipos** a los torneos
- **Crear y asignar jugadores** a los equipos
- **Definir las sanciones y valores de las tarjetas**
- **Cargar partidos y resultados** de los mismos
- **Gestionar Roles y permisos** asignar los roles y los permisos a los diferentes usuarios de la app

### Usuario NO Administrador

Este usuario/s sera creado por el usuario Admin, podra acceder a las funcionalidades segun los permisos que se le consedan. 
No podra acceder a la funcionalidad de "Roles y Permisos" ya que esta restringida unicamente para el usuario Admin

## Información de Creación

Esta aplicación ha sido desarrollada utilizando **Laravel** como framework principal y se apoya en **Docker** para la creación de entornos de desarrollo y despliegue. Su arquitectura es de tipo monolítica, empleando **Blade** como motor de plantillas, integrando **Tailwinds CCS** para el diseño de la interfaz de usuario. La base de datos utilizada es **MySQL**. 

**NOTA** He utilizado IA para apoyarme en algunas partes del codigo de la aplicacion.
- En las vistas para aplicar los estilos y diseño. Codificacion de modals y acesoramiento para siertas partes como en el index de partidos
- En codigo para la complegidad de algunas consultas, configuracion del archivo vite, configuracion de reglas de exepciones global en archivo "Handler.php", correcion de errores en el codigo de Servicio

El proyecto se gestiona mediante **Git** y **GitHub** para el control de versiones. Asimismo, se utilizan **GitHub Actions** para automatizar el proceso de despliegue.

Es importante señalar que, debido a las restricciones y limitaciones del servicio de hosting gratuito, parte del código y la configuración han sido adaptados para asegurar su correcto funcionamiento en el entorno web.