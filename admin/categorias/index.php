<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$sql = "SELECT * FROM categorias ORDER BY id_categoria DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Gestión de categorías</p>
        </div>

        <nav class="menu">
            <a href="../panel.php">Panel</a>
            <a href="index.php">Categorías</a>
            <a href="../servicios/index.php">Servicios</a>
            <a href="../cotizaciones/index.php">Cotizaciones</a>
            <a href="../usuarios/index.php">Usuarios</a>
            <a href="../../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Categorías</h2>

            <p class="texto-seccion">
                Desde esta sección se administran las categorías usadas para organizar los servicios.
            </p>

            <a href="agregar.php" class="boton-principal">Agregar categoría</a>

            <div class="tabla-contenedor">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($categoria = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $categoria["id_categoria"]; ?></td>
                                <td><?php echo $categoria["nombre_categoria"]; ?></td>
                                <td><?php echo $categoria["descripcion"]; ?></td>
                                <td>
                                    <?php 
                                    if ($categoria["estado"] == 1) {
                                        echo "Activa";
                                    } else {
                                        echo "Inactiva";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $categoria["id_categoria"]; ?>" class="accion-editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $categoria["id_categoria"]; ?>" class="accion-eliminar">Eliminar</a>
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