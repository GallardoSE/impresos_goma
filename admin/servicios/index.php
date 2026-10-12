<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$sql = "SELECT 
            servicios.id_servicio,
            servicios.nombre_servicio,
            servicios.descripcion,
            servicios.imagen,
            servicios.estado,
            categorias.nombre_categoria
        FROM servicios
        INNER JOIN categorias 
            ON servicios.id_categoria = categorias.id_categoria
        ORDER BY servicios.id_servicio DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Gestión de servicios</p>
        </div>

        <nav class="menu">
            <a href="../panel.php">Panel</a>
            <a href="../categorias/index.php">Categorías</a>
            <a href="index.php">Servicios</a>
            <a href="../cotizaciones/index.php">Cotizaciones</a>
            <a href="../usuarios/index.php">Usuarios</a>
            <a href="../../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Servicios</h2>

            <p class="texto-seccion">
                Desde esta sección se administran los servicios que aparecen en el catálogo público.
            </p>

            <a href="agregar.php" class="boton-principal">Agregar servicio</a>

            <div class="tabla-contenedor">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Servicio</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($servicio = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $servicio["id_servicio"]; ?></td>
                                <td>
                                    <strong><?php echo $servicio["nombre_servicio"]; ?></strong><br>
                                    <?php echo $servicio["descripcion"]; ?>
                                </td>
                                <td><?php echo $servicio["nombre_categoria"]; ?></td>
                                <td><?php echo $servicio["imagen"]; ?></td>
                                <td>
                                    <?php 
                                    if ($servicio["estado"] == 1) {
                                        echo "Activo";
                                    } else {
                                        echo "Inactivo";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $servicio["id_servicio"]; ?>" class="accion-editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $servicio["id_servicio"]; ?>" class="accion-eliminar">Eliminar</a>
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