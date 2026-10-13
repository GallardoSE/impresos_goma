<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = "/impresos_goma/";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : "Panel Administrativo - Impresos Goma"; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $base_url; ?>assets/img/logo_Impresos_Goma.png">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/estilos.css">
</head>
<body>

<a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <a href="<?php echo $base_url; ?>admin/panel.php" title="Ir al panel">
                <img src="<?php echo $base_url; ?>assets/img/logo_Impresos_Goma.png" alt="Logo Impresos Goma" class="logo-img">
            </a>
            <div>
                <h1>Panel administrativo</h1>
                <p>Impresos Goma</p>
            </div>
        </div>

        <nav class="menu" aria-label="Navegación del panel">
            <a href="<?php echo $base_url; ?>admin/panel.php">Panel</a>
            <a href="<?php echo $base_url; ?>admin/categorias/index.php">Categorías</a>
            <a href="<?php echo $base_url; ?>admin/servicios/index.php">Servicios</a>
            <a href="<?php echo $base_url; ?>admin/cotizaciones/index.php">Cotizaciones</a>
            <a href="<?php echo $base_url; ?>admin/usuarios/index.php">Usuarios</a>
            <a href="<?php echo $base_url; ?>index.php" target="_blank" title="Ver sitio público">Ver Sitio ↗</a>
            <a href="<?php echo $base_url; ?>logout.php">Cerrar sesión</a>

            <div class="switch-theme-container">
                <button id="theme-toggle" class="switch-btn" role="switch" aria-checked="false" aria-label="Cambiar entre modo claro u oscuro">
                    <span class="switch-text">I</span>
                    <span class="switch-thumb"></span>
                    <span class="switch-text">O</span>
                </button>
            </div>
        </nav>
    </div>
</header>

<main id="contenido-principal">
