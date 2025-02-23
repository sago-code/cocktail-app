<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Cocktail App

# Prueba tecnica realizada por Santiago Orjuela Vera (sago-code)

## Descripción de la Prueba Técnica

Esta aplicación permite gestionar una lista de cócteles, incluyendo la funcionalidad para listar, crear, actualizar y eliminar cócteles. La imagen de cada cóctel se maneja como una URL almacenada en la base de datos.

### Funcionalidades Implementadas

1. **Listar Cócteles**: Muestra una lista de cócteles almacenados.
2. **Crear Cóctel**: Permite agregar un nuevo cóctel con su nombre, categoría, estado alcohólico y URL de imagen.
3. **Actualizar Cóctel**: Permite actualizar los datos de un cóctel existente, incluyendo la imagen.
4. **Eliminar Cóctel**: Permite eliminar un cóctel de la lista.

## Instalación de Dependencias

### Requisitos Previos

- PHP >= 7.3
- Composer
- Node.js y npm

### Pasos para la Instalación

1. **Clonar el repositorio**

   ```sh
   git clone https://github.com/tu-usuario/cocktail-app.git
   cd cocktail-app

2. **Instalar dependencias de PHP con Composer**

    ```sh
    composer install

3. **Instalar dependencias de Node.js con npm**

    ```sh
    npm install

4. **Configurar el archivo .env**

    Por si no funciona el .env que ya tiene el proyecto. Copia el archivo .env.example a .env y configura las variables de entorno, especialmente la conexión a la base de datos.

    ```sh
    cp .env.example .env

5. **Generar la clave de la aplicación**

    ```sh
    php artisan key:generate

6. **Ejecutar las migraciones de la base de datos**

    ```sh
    php artisan migrate

7. **Ejecutar la aplicacion**

    ```sh
    composer run dev

**La aplicación estara disponible en (http://localhost:8000)**