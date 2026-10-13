<?php
// Definimos la ruta base del proyecto para que funcione dentro de la raíz o dentro de /admin/
$base_url = "/impresos_goma/";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresos Goma</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $base_url; ?>assets/img/logo_Impresos_Goma.png">

    <!-- Archivo principal de estilos -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/estilos.css">
</head>

<body>

    <a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

    <header class="encabezado">
        <div class="contenedor encabezado-contenido">
            <div class="logo-area">
                <a href="<?php echo $base_url; ?>index.php" title="Ir al inicio">
                    <img src="<?php echo $base_url; ?>assets/img/logo_Impresos_Goma.png" alt="Logo Impresos Goma" class="logo-img">
                </a>

                <div>
                    <h1>Impresos Goma</h1>
                    <p>Serigrafía, rótulos, bordados y personalización</p>
                </div>
            </div>

            <nav class="menu" aria-label="Navegación principal">
                <a href="<?php echo $base_url; ?>index.php">Inicio</a>
                <a href="<?php echo $base_url; ?>catalogo.php">Servicios</a>
                <a href="<?php echo $base_url; ?>galeria.php">Galería</a>
                <a href="<?php echo $base_url; ?>cotizacion.php">Cotización</a>
                <a href="<?php echo $base_url; ?>contacto.php">Contacto</a>
                <a href="<?php echo $base_url; ?>admin/panel.php">Admin</a>

                <div class="switch-theme-container">
                    <button id="theme-toggle" class="switch-btn" role="switch" aria-checked="false"
                        aria-label="Cambiar entre modo claro u oscuro">
                        <span class="switch-text">I</span>
                        <span class="switch-thumb"></span>
                        <span class="switch-text">O</span>
                    </button>
                </div>
            </nav>
        </div>
    </header>