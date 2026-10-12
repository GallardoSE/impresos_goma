<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../login.php");
    exit;
}

include("../config/conexion.php");

$total_servicios = $conexion->query("SELECT COUNT(*) AS total FROM servicios")->fetch_assoc()["total"];
$total_categorias = $conexion->query("SELECT COUNT(*) AS total FROM categorias")->fetch_assoc()["total"];
$total_cotizaciones = $conexion->query("SELECT COUNT(*) AS total FROM cotizaciones")->fetch_assoc()["total"];
$cotizaciones_pendientes = $conexion->query("SELECT COUNT(*) AS total FROM cotizaciones WHERE estado = 'Pendiente'")->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel administrativo - Impresos Goma</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Impresos Goma</p>
        </div>

        <nav class="menu">
            <a href="panel.php">Panel</a>
            <a href="categorias/index.php">Categorías</a>
            <a href="servicios/index.php">Servicios</a>
            <a href="cotizaciones/index.php">Cotizaciones</a>
            <a href="usuarios/index.php">Usuarios</a>
            <a href="../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Bienvenido, <?php echo $_SESSION["nombre"]; ?></h2>

            <p class="texto-seccion">
                Desde este panel puedes administrar la información principal del sistema.
            </p>

            <div class="tarjetas">
                <div class="tarjeta">
                    <h3>Servicios</h3>
                    <p>Total registrados: <?php echo $total_servicios; ?></p>
                </div>

                <div class="tarjeta">
                    <h3>Categorías</h3>
                    <p>Total registradas: <?php echo $total_categorias; ?></p>
                </div>

                <div class="tarjeta">
                    <h3>Cotizaciones</h3>
                    <p>Total recibidas: <?php echo $total_cotizaciones; ?></p>
                </div>

                <div class="tarjeta">
                    <h3>Pendientes</h3>
                    <p>Cotizaciones pendientes: <?php echo $cotizaciones_pendientes; ?></p>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="pie">
    <div class="pie-copy">
        <p>&copy; 2026 Impresos Goma. Panel administrativo.</p>
    </div>
</footer>

</body>
</html>