# AgroShare

## Descripción General de la plataforma
AgroShare es una plataforma digital orientada al sector agropecuario de Nicaragua que optimiza la comercialización directa entre productores locales y compradores, reduciendo los márgenes de intermediación y garantizando inclusión mediante una arquitectura segura y accesible.

Este repositorio contiene la estructura base en Laravel, abarcando la configuración del entorno, base de datos relacional y arquitectura de software.


## Tecnologías Utilizadas
- **Lenguaje Principal:** PHP
- **Framework Backend:** Laravel
- **Framework Frontend:** Tailwind / HTML5 / CSS3
- **Motor de Base de Datos:** MySQL (Servidor local XAMPP)
- **Gestor de Dependencias:** Composer
- **Control de Versiones:** Git & GitHub


## Control de Acceso y Roles de Seguridad
La arquitectura del sistema contempla una gestión de usuarios fundamentada en tres roles principales:

1. **Administrador:** Control general de la plataforma, métricas y administración de usuarios.
2. **Usuario (Productor / Comprador):** Publicación, búsqueda y comercialización directa de productos.
3. **Auditor:** Inspección de registros del sistema, trazabilidad de operaciones y validación técnica sin permisos de edición.


## Requisitos Previos Mínimos
- **Servidor Local:** XAMPP/Laragon
- **PHP:** >= 8.1
- **Composer:** Instalado en el sistema
- **MySQL Server:** Activo en puerto 3306


## Instalación Básica y Ejecución del Sistema

Ejecute la siguiente secuencia unificada de comandos en su terminal para desplegar el proyecto localmente (asegúrese de tener el servicio de MySQL encendido en Laragon):

```bash
# 1. Clonar el repositorio e ingresar al directorio
git clone https://github.com/EnocZamora/AgroShare
# Elegir la ruta de preferencia para los archivos clonados.
# 2. Instalar el entorno de desarrollo laragon desde su web oficial (Verción full)
https://laragon.org/download

# 3. Crear el archivo de configuración .env
cp .env.example .env

# 4. Generar la clave de la aplicación
php artisan key:generate

# 5. Ejecutar migraciones de la base de datos
php artisan migrate

# 6. Iniciar el servidor local
php artisan serve
