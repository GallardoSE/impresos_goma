<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$sql = "SELECT * FROM usuarios ORDER BY id_usuario DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Gestión de usuarios administradores</p>
        </div>

        <nav class="menu">
            <a href="../panel.php">Panel</a>
            <a href="../categorias/index.php">Categorías</a>
            <a href="../servicios/index.php">Servicios</a>
            <a href="../cotizaciones/index.php">Cotizaciones</a>
            <a href="index.php">Usuarios</a>
            <a href="../../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Usuarios administradores</h2>

            <p class="texto-seccion">
                Desde esta sección se administran los usuarios que pueden iniciar sesión en el sistema.
            </p>

            <a href="agregar.php" class="boton-principal">Agregar usuario</a>

            <div class="tabla-contenedor">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $usuario["id_usuario"]; ?></td>
                                <td><?php echo $usuario["nombre"]; ?></td>
                                <td><?php echo $usuario["correo"]; ?></td>
                                <td><?php echo $usuario["rol"]; ?></td>
                                <td>
                                    <?php 
                                    if ($usuario["estado"] == 1) {
                                        echo "Activo";
                                    } else {
                                        echo "Inactivo";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $usuario["fecha_registro"]; ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo $usuario["id_usuario"]; ?>" class="accion-editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $usuario["id_usuario"]; ?>" class="accion-eliminar">Eliminar</a>
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