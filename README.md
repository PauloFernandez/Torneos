# 🏆 Sistema de Gestión de Torneos de Fútbol

## Descripción general

Aplicación web desarrollada en **Laravel** para la gestión integral de torneos de fútbol en distintas categorías.
El sistema permite administrar torneos, equipos, jugadores, árbitros, canchas y partidos, controlando el acceso mediante **roles y permisos** según el perfil del usuario.

Está pensada tanto para **organizadores de torneos**, que necesitan un panel administrativo completo, como para jugadores, que acceden a la información del torneo en el que participan (estadísticas, posiciones, resultados) y pueden gestionar su perfil personal.

El proyecto fue desarrollado como **proyecto integrador**, con foco en lógica de negocio real y escalabilidad.

🌐 **Demo online:**
[https://torneosapp.infinityfreeapp.com](https://torneosapp.infinityfreeapp.com/)

Incluye datos de prueba y múltiples perfiles de usuario para explorar el sistema desde diferentes roles (administrador, usuario y jugador).

---

## Características principales

### 🔐 Administración

- Gestión completa de **torneos** (categoría, fechas, costos, premios, reglas, visibilidad pública)
- CRUD de **equipos** con carga de imagen (escudo)
- CRUD de **usuarios** con asignación de roles y estado activo/inactivo
- **Importación masiva de usuarios** (ideal para jugadores)
- Gestión de **jugadores** con asignación a equipos (relación intermedia)
- Gestión de **partidos** con:
  - Asignación de torneo, equipos, cancha y árbitro
  - Control de estados (Programado, Finalizado, Suspendido, Cancelado)
  - Carga y edición de resultados mediante modal
- Registro de:
  - Goles
  - Tarjetas
  - Estadísticas por jugador
- CRUD de **canchas, árbitros y sanciones**
- Buscador y paginación en módulos clave
- Manejo de errores y validaciones mediante **Form Requests**
- Control de eliminación de datos sensibles desde *Handler.php*

---

### ⚽ Jugadores / Público

- Acceso a la información del torneo en el que participan
- Visualización de:
  - Partidos
  - Resultados
  - Tabla de posiciones
  - Goleadores
  - Estadísticas
- **Edición de perfil personal**
- Interfaz diferenciada del panel administrativo

---

### 👥 Roles y permisos

- **Administrador (Admin)**
Acceso total al sistema y gestión completa de todos los módulos
- **Usuario administrativo (Usuario)**
Acceso parcial al panel, con permisos asignados por el administrador.
- **Jugador / Público**
Acceso solo a vistas informativas del torneo y edición de su perfil, sin acceso al panel administrativo.

---

### 🛠 Stack tecnológico

**Backend**
  - PHP 8.x
  - Laravel (framework MVC)
  - Eloquent ORM
  - Laravel Form Requests (validaciones)
  - Middleware para control de acceso
  - Notifications & Listeners

**Frontend**
  - Blade Templates
  - Tailwind CSS
  - JavaScript (funcionalidades básicas)
  - Modales para carga y edición de datos

**Base de datos**
  - MySQL
  - Migraciones y seeders

**Otros**
  - Mailtrap (testing de envío de emails)
  - Servicio reutilizable para carga de imágenes
  - Despliegue en hosting cloud
  
---

### 🧱 Arquitectura y decisiones técnicas

El proyecto sigue el patrón **MVC** de Laravel, separando claramente la lógica de negocio, las vistas y el acceso a datos.

Principales decisiones técnicas:
  - Uso de **relaciones Eloquent** (*hasMany, belongsTo, belongsToMany*) para modelar torneos, equipos, jugadores y partidos.
  - Implementación de **roles y permisos** con control de acceso mediante middleware.
  - Uso de **Form Requests** para validaciones y manejo de errores.
  - Creación de un **servicio reutilizable** para la carga de imágenes, evitando duplicación de código en los módulos de equipos y usuarios.
  - Manejo de excepciones personalizadas en *Handler.php* para proteger la eliminación de entidades sensibles (canchas, árbitros, etc.).
  - Implementación de **Notifications y Listeners** para el envío de correos de bienvenida a usuarios creados individualmente.
  - Separación de vistas entre **panel administrativo** y **vistas públicas/jugador**, según rol autenticado.
  - Lógica de negocio avanzada en el módulo de **Partidos**, incluyendo:
    - Estados del partido
    - Validación de fechas
    - Habilitación dinámica de acciones (editar / cargar resultados)
    - Registro de estadísticas por jugador
  
---

### 🤖 Uso de IA en el desarrollo

El proyecto fue desarrollado de forma **independiente**, utilizando herramientas de **Inteligencia Artificial como apoyo** durante el proceso de desarrollo, principalmente para:

  - Resolución de errores puntuales
  - Refactorización y mejora de código
  - Optimización de controladores y vistas
  - Exploración de estilos visuales con Tailwind CSS

En todos los casos, la IA fue utilizada como **herramienta de asistencia**, manteniendo siempre el control y la comprensión de la lógica implementada.
---

### 🚧 Estado del proyecto

  - ✔ Funcional y desplegado en la nube
  - ✔ Flujo completo de administración y visualización
  - 🚧 Algunas funcionalidades pensadas para el futuro no están implementadas aún, como:
    - Facturación y costos automáticos
    - Reserva individual de canchas
    - Envío de notificaciones masivas por email

Estas mejoras fueron contempladas a nivel de diseño para facilitar una futura expansión del sistema.

---

## 🚀 Instalación y configuración

```bash
  git clone https://github.com/PauloFernandez/Torneos.git
  cd Torneos
  composer install
  cp .env.example .env
  php artisan key:generate
  php artisan migrate --seed
  npm install
  npm run build
  php artisan serve
```
---

### 👤 Autor

Paulo Fernández
Desarrollador Web Backend (Laravel)
  - GitHub: [https://github.com/PauloFernandez](https://github.com/PauloFernandez)
  - Proyecto: [https://torneosapp.infinityfreeapp.com/](https://torneosapp.infinityfreeapp.com/)
