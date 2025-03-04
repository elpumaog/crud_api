# CRUD de Usuarios

Este es un proyecto de **CRUD** (Crear, Leer, Actualizar, Eliminar) para gestionar usuarios, desarrollado utilizando **HTML**, **CSS**, **JavaScript**, **PHP** y **MySQL** que he creado como práctica para mi aprendizaje.

Este proyecto permite realizar operaciones CRUD en una base de datos de usuarios y proporciona una interfaz frontend donde se pueden agregar, editar y eliminar usuarios de forma sencilla.

## Teconologías utilizadas

- **Frontend**
  - HTML
  - CSS
  - JavaScript (fetch API)

- **Backend**
  - PHP
  - MySQL (base de datos)

## Requisitos

Antes de ejecutar este proyecto, asegurate de tener instalados los siguientes programas:

- **Servidor Web** como Apache o Nginx (Se recomienda usar [XAMPP](https://www.apachefriends.org/) o [WAMP](http://www.wampserver.com/)).
- **Base de datos MySQL**.
- **Editor de código** (como VSCode o Sublime Text).

## Instrucciones de Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/elpumaog/crud_api.git
```

### 2. Configuración de la base de datos

- Crea una base de datos llamada crud_api en MySQL
```bash
CREATE DATABASE crud_api;
```

- Ejecuta el siguiente script SQL para crear la tabla de usuarios:
```bash
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefono VARCHAR(20) NOT NULL
);
```

### 3. Configuración del backend (API)

- Asegurate de que los archivos PHP estén en la carpeta raíz de tu servidor web local.
- Asegurate de que la conexion a la base de datos esté configurada correctamente en el archivo api.php.

### 4. Ejecutar el proyecto

- Abre tu navegador web y navega a http://localhost/(nombre de la carpeta)/ para acceder a la interfaz frontend.
- Ahora podrás ver la lista de usuarios y utilizar las funciones CRUD (Crear, Leer, Actualizar, Eliminar) desde el frontend.

## Contribuciones

Si deseas contribuir a este proyecto, sigue estos pasos:

- Haz un fork de este repositorio.
- Crea una nueva rama
```bash
git checkout -b feature/nueva-funcionalidad
```
- Realiza tus cambios y haz un commit
```bash
git commit -m 'Agregada nueva funcionalidad'
```
- Sube los cambios a tu fork
```bash
git push origin feature/nueva-funcionalidad
```
- Crea un Pull Request explicando los cambios realizados

## Contacto

Si tienes alguna pregunta, sugerencia u opinion puedes escribirme en:

Email: alejandrogomezalarcon1@gmail.com
Github: https://github.com/elpumaog
