# Proyecto DIOR

Bienvenido al proyecto DIOR, una plataforma de comercio electrónico que permite a los usuarios navegar y comprar productos de manera eficiente y segura. Este proyecto está diseñado utilizando Laravel y es ideal para quienes buscan aprender y experimentar con el desarrollo web moderno.

## Tabla de Contenidos

- [Características](#características)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Instalación](#instalación)
- [Uso](#uso)
- [Estructura de la Base de Datos](#estructura-de-la-base-de-datos)
- [Contribución](#contribución)
- [Licencia](#licencia)
- [Contacto](#contacto)

## Características

- **Interfaz de Usuario Amigable**: Diseño moderno y responsivo que mejora la experiencia del usuario.
- **Autenticación de Usuarios**: Los usuarios pueden registrarse e iniciar sesión para acceder a funcionalidades personalizadas.
- **Gestión de Productos**: Los administradores pueden agregar, editar y eliminar productos fácilmente.
- **Carrito de Compras**: Los usuarios pueden agregar productos al carrito y proceder al checkout.
- **Integración con Google Maps**: Selección de ubicación de entrega mediante Google Maps.
- **Envío de Notificaciones por Correo Electrónico**: Confirmaciones y actualizaciones sobre el estado de los pedidos.

## Tecnologías Utilizadas

- **Backend**: 
  - PHP (Laravel)
- **Frontend**:
  - HTML
  - CSS
- **Base de Datos**:
  - MySQL
- **API**:
  - Google Maps API para la selección de ubicación de entrega

## Instalación

Para ejecutar el proyecto localmente, sigue estos pasos:

1. **Clona el repositorio**:
    ```bash
    git clone https://github.com/tu-usuario/dior.git
    cd dior
    ```

2. **Instala las dependencias**:
    ```bash
    composer install
    npm install
    ```

3. **Crea un archivo `.env`** a partir del archivo `.env.example`:
    ```bash
    cp .env.example .env
    ```

4. **Configura tu base de datos** en el archivo `.env`:
    ```
    DB_DATABASE=tu_basedatos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

5. **Genera la clave de la aplicación**:
    ```bash
    php artisan key:generate
    ```

6. **Ejecuta las migraciones** para crear las tablas en la base de datos:
    ```bash
    php artisan migrate
    ```

7. **Inicia el servidor**:
    ```bash
    php artisan serve
    ```

## Uso

1. Abre tu navegador y visita `http://localhost:8000`.
2. Regístrate o inicia sesión para comenzar a explorar la tienda.
3. Navega por los productos, agrégales al carrito y procede al checkout.

## Estructura de la Base de Datos

Las tablas principales en la base de datos incluyen:

- `users`: Información de los usuarios.
- `products`: Datos sobre los productos disponibles.
- `carts`: Información sobre los carritos de compra de los usuarios.
- `orders`: Detalles de las órdenes realizadas.
- `addresses`: Direcciones de entrega.

## Contribución

¡Contribuciones son bienvenidas! Si deseas contribuir a este proyecto, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea tu rama de características (`git checkout -b feature/nueva-caracteristica`).
3. Realiza tus cambios y haz commit (`git commit -m 'Agregué una nueva característica'`).
4. Envía tu rama (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.

## Licencia

Este proyecto está bajo la Licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).

## Contacto

Desarrollador: Carlos Taracena  
Email: [calitostaracenacoronado@gmail.com](mailto:calitostaracenacoronado@gmail.com)  
Redes Sociales:  
[Instagram](https://www.instagram.com/tu_usuario) | [LinkedIn](https://www.linkedin.com/in/tu_usuario)  

---

¡Gracias por visitar el proyecto DIOR!
