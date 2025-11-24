# Tarea 3 - Uso de Git y Git Flow

CRUD de estudiantes hecho en PHP y MySQL 

## Descripción

La aplicación permite:

- Listar estudiantes
- Crear estudiantes
- Editar estudiantes
- Eliminar estudiantes

Campos de la tabla `students`:

- id
- name
- email
- career

## Base de datos

## Cómo probar el proyecto de forma local

1. Crear la base de datos `tarea3_gitflow` en MySQL.
2. Importar o crear la tabla `students` con los campos id, name, email y career.
3. Ajustar el usuario y la contraseña de la base de datos en `db.php` si es necesario.
4. Colocar el proyecto en la carpeta del servidor local (por ejemplo, en XAMPP o Laragon).
5. Abrir en el navegador la ruta `http://localhost/.../index.php` para ver el CRUD de estudiantes.

Nombre de la base de datos: `tarea3_gitflow`.

Tabla sugerida:

```sql
CREATE DATABASE IF NOT EXISTS tarea3_gitflow CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tarea3_gitflow;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    career VARCHAR(100) NOT NULL
);

