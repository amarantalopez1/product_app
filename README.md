<H1>Product-app</H1>
Este proyecto es una aplicación web para la gestión de productos, incluyendo funcionalidades para crear, actualizar, visualizar y eliminar productos.

Instalación
Siga estos pasos para configurar el proyecto en tu máquina local:

- Clona el repositorio:

git clone https://github.com/amarantalopez1/product_app.git

-Navega al directorio del proyecto:

cd product_app

-Instala las dependencias:

composer install
npm install

-Genera una nueva clave de aplicación:

php artisan key:generate

Conexión a la base de datos: La aplicación ya está configurada para conectarse a una base de datos en AWS RDS.

-Inicia el servidor de desarrollo:

php artisan serve

<H1>Uso</H1>
Después de iniciar el servidor de desarrollo, puedes acceder a la aplicación en http://localhost:8000. Desde aquí, podrá realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para gestionar los productos.
para iniciar sesión.
User: Amaranta
Password: Amaranta

Características
Listado de productos: Ver todos los productos disponibles.
Creación de productos: Agregar nuevos productos con sus detalles.
Actualización de productos: Modificar información existente de los productos.
Eliminación de productos: Eliminar productos del sistema.
Tecnologías
Backend: Laravel
Frontend: HTML, CSS, JavaScript
Base de datos: MySQL (AWS RDS)
