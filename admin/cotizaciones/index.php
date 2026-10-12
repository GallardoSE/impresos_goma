<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

// Consulta especial JOIN:
// Une cotizaciones, detalle_cotizacion, servicios y categorias.
$sql = "SELECT 
            cotizaciones.id_cotizacion,
            cotizaciones.nombre_cliente,
            cotizaciones.telefono,
            cotizaciones.correo,
            cotizaciones.fecha_solicitud,
            cotizaciones.estado,
            servicios.nombre_servicio,
            categorias.nombre_categoria,
            detalle_cotizacion.cantidad,
            detalle_cotizacion.material
        FROM cotizaciones
        INNER JOIN detalle_cotizacion 
            ON cotizaciones.id_cotizacion = detalle_cotizacion.id_cotizacion
        INNER JOIN servicios 
            ON detalle_cotizacion.id_servicio = servicios.id_servicio
        INNER JOIN categorias 
            ON servicios.id_categoria = categorias.id_categoria
        ORDER BY cotizaciones.fecha_solicitud DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotizaciones - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Gestión de cotizaciones</p>
        </div>

        <nav class="menu">
            <a href="../panel.php">Panel</a>
            <a href="../categorias/index.php">Categorías</a>
            <a href="../servicios/index.php">Servicios</a>
            <a href="index.php">Cotizaciones</a>
            <a href="../usuarios/index.php">Usuarios</a>
            <a href="../../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Solicitudes de cotización</h2>

            <p class="texto-seccion">
                Esta sección muestra las solicitudes enviadas por los clientes.
                Aquí se usa la consulta especial JOIN del sistema.
            </p>

            <div class="tabla-contenedor">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Contacto</th>
                            <th>Servicio</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Material</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($cotizacion = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $cotizacion["id_cotizacion"]; ?></td>
                                <td><?php echo $cotizacion["nombre_cliente"]; ?></td>
                                <td>
                                    Tel: <?php echo $cotizacion["telefono"]; ?><br>
                                    Correo: <?php echo $cotizacion["correo"]; ?>
                                </td>
                                <td><?php echo $cotizacion["nombre_servicio"]; ?></td>
                                <td><?php echo $cotizacion["nombre_categoria"]; ?></td>
                                <td><?php echo $cotizacion["cantidad"]; ?></td>
                                <td><?php echo $cotizacion["material"]; ?></td>
                                <td><?php echo $cotizacion["fecha_solicitud"]; ?></td>
                                <td><?php echo $cotizacion["estado"]; ?></td>
                                <td>
                                    <a href="ver.php?id=<?php echo $cotizacion["id_cotizacion"]; ?>" class="accion-editar">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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