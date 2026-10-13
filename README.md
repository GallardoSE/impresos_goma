# Sistema Web de Catálogo y Cotizaciones - Impresos Goma

Proyecto desarrollado para la asignatura **Interacción Humano-Computadora** (Universidad de Guadalajara - CUCosta) aplicando principios de Diseño Centrado en el Usuario (ISO 9241-210) y accesibilidad web (WCAG 2.2 AA).

## Requisitos de Ejecución
- **Servidor Web:** Apache (XAMPP / WAMP / MAMP)
- **Lenguaje:** PHP 8.x
- **Base de Datos:** MySQL / MariaDB
- **Navegador:** Chrome, Firefox, Edge o Safari

## Instalación y Despliegue Local
1. Copiar la carpeta `impresos_goma` dentro del directorio `htdocs` de XAMPP (`C:\xampp\htdocs\impresos_goma`).
2. Iniciar los módulos **Apache** y **MySQL** desde el Panel de Control de XAMPP.
3. Abrir phpMyAdmin en `http://localhost/phpmyadmin/`.
4. Crear una base de datos llamada `impresos_goma`.
5. Importar el archivo `impresos_goma.sql` situado en la raíz del proyecto.
6. Acceder a la aplicación mediante la URL: `http://localhost/impresos_goma/`.

## Estructura del Proyecto
- `index.php` - Portal principal de bienvenida.
- `catalogo.php` - Catálogo público de servicios.
- `detalle_servicio.php` - Ficha técnica de cada servicio.
- `cotizacion.php` - Formulario de solicitud de presupuesto.
- `guardar_cotizacion.php` - Procesador del envío de solicitudes.
- `login.php` - Autenticación de administradores.
- `admin/` - Panel de administración para gestión de solicitudes y catálogo.
- `assets/` - Archivos de estilos CSS, scripts JS e imágenes del sistema.
- `impresos_goma.sql` - Respaldo de la base de datos MySQL.

## Accesibilidad y Usabilidad
- Cumplimiento de contraste cromático mínimo 4.5:1 (WCAG 2.2 AA).
- Navegación completa mediante teclado (indicadores de foco visible).
- Diseño responsivo adaptado a dispositivos móviles, tabletas y escritorio.