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

## Credenciales de Acceso (Panel de Administración)
Para evaluar las funciones de gestión del sistema, utiliza los siguientes datos de prueba tras cargar la base de datos:
- **URL de acceso:** `http://localhost/impresos_goma/login.php`
- **Correo:** `admin@impresosgoma.com` *(o el registrado en tu BD)*
- **Contraseña:** `admin123` *(o la correspondiente en tu BD)*

## Estructura del Proyecto
- `index.php`: Portal principal de bienvenida.
- `catalogo.php`: Catálogo público de servicios ordenados por categoría.
- `detalle_servicio.php`: Ficha técnica e información detallada de cada servicio.
- `cotizacion.php`: Formulario dinámico de solicitud de presupuesto.
- `guardar_cotizacion.php`: Procesador y validador de envíos de cotizaciones.
- `login.php`: Autenticación segura para usuarios administradores.
- `includes/`: Componentes modulares reutilizables (encabezados, pies de página, navegación y scripts de tema).
- `admin/`: Panel de administración modularizado:
  - `panel.php`: Dashboard con métricas de solicitudes y estado del sistema.
  - `categorias/`: Gestión de categorías del catálogo (CRUD).
  - `servicios/`: Gestión de servicios e imágenes (CRUD).
  - `cotizaciones/`: Revisión y cambio de estado de solicitudes recibidas.
  - `usuarios/`: Control de usuarios administradores con acceso al panel.
- `assets/`: Estilos CSS globales, scripts JS (modo oscuro, scroll) e imágenes.
- `impresos_goma.sql`: Respaldo completo de la estructura y datos de la base de datos MySQL.

## Accesibilidad (WCAG 2.2 AA) y Usabilidad (ISO 9241-210)
- **Contraste de color:** Cumplimiento de contraste cromático mínimo 4.5:1 en texto normal y componentes interactivos.
- **Conmutador de Tema (I / O):** Modo claro y oscuro con persistencia de preferencia mediante `localStorage` y atributos `data-theme`.
- **Navegación por Teclado:** Foco visible en elementos interactivos y enlace de salto directo al contenido principal (`skip-link`).
- **Semántica y Lectores de Pantalla:** Uso de roles y atributos ARIA (`role="switch"`, `aria-checked`, etiquetado estricto `label/for` en formularios).
- **Componentes Flotantes:** Botón de contacto directo por WhatsApp y botón de retorno al extremo superior de página (*smooth scroll*).
- **Diseño Responsivo:** Adaptación fluida a dispositivos móviles, tabletas y monitores de escritorio.