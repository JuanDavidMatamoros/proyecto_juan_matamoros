# Proyecto Laravel: Gestión de Clubes Deportivos

Aplicación web construida en Laravel para gestionar **clubes deportivos** y **jugadores**.  
Permite a los usuarios autenticados crear, listar, editar y eliminar equipos y jugadores.

---

## Funcionalidades principales

- **Autenticación de usuarios** (registro, login y logout usando Laravel Breeze).
- **CRUD de Equipos**:
    - Crear nuevos equipos (con nombre, ciudad, categoría, año de fundación y propietario).
    - Editar y eliminar equipos (sólo si son del usuario autenticado).
    - Ver detalles del equipo, incluyendo jugadores asociados.
- **CRUD de Jugadores**:
    - Crear jugadores y asignarlos a equipos.
    - Editar datos de los jugadores.
    - Eliminar jugadores (solo si no están asignados a un equipo).
    - Listar jugadores por equipo.
- **Relaciones**:
    - **Usuario** → puede tener **muchos Equipos**. (1:N)
    - **Equipo** → puede tener **muchos Jugadores**. (1:N)
    - **Jugador** → **pertenece a un único Equipo**. (N:1)
- **Filtros**:
    - Filtrar equipos por propietario.
    - Filtrar jugadores por equipo.
- **Paginación** de resultados.

---

## Requisitos

- PHP 8.1 o superior
- Composer
- Laravel 10
- Base de datos MySQL o equivalente

---

## Instalación

1. Clona el repositorio:

```bash
  git clone https://github.com/JuanDavidMatamoros/proyecto_juan_matamoros.git
``` 
2. Entra a la carpeta del proyecto:
```bash
  cd proyecto_juan_matamoros
``` 
3. Instala las dependencias de PHP:
```bash
  composer install
``` 
4. Copia el archivo de configuración .env:
```bash
  cp .env.example .env  
``` 
5. Genera la clave de la aplicación:
```bash
  php artisan key:generate
``` 
6. Configura tu base de datos en el archivo .env.
7. Ejecuta las migraciones y seeders:
```bash
  php artisan migrate --seed
``` 
8. Inicia el servidor local:
```bash
  php artisan serve

``` 

# **Datos de prueba**
Se crea automáticamente un usuario de prueba:
* Email: test@example.com
* Contraseña: password

# **Estructura de tablas principales**

* Users (usuarios del sistema)
* Equipos (clubes deportivos)
* Jugadores (jugadores asociados a equipos)

## Créditos:

Proyecto realizado por Juan David Matamoros. Construido con ❤️ usando Laravel y Bootstrap 5.
