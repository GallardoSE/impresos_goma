<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = $_POST["nombre_categoria"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO categorias (nombre_categoria, descripcion, estado)
            VALUES ('$nombre_categoria', '$descripcion', '$estado')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al guardar la categoría: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar categoría - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Agregar categoría</p>
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
            <h2 class="titulo-seccion">Agregar categoría</h2>

            <p class="texto-seccion">
                Registra una nueva categoría para organizar los servicios del catálogo.
            </p>

            <?php if ($mensaje != "") { ?>
                <div class="mensaje-error">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form class="formulario" method="POST" action="agregar.php">
                <div class="grupo-formulario">
                    <label>Nombre de la categoría</label>
                    <input type="text" name="nombre_categoria" required>
                </div>

                <div class="grupo-formulario">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4"></textarea>
                </div>

                <div class="grupo-formulario">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactiva</option>
                    </select>
                </div>

                <button type="submit" class="boton-principal">
                    Guardar categoría
                </button>

                <a href="index.php" class="boton-secundario-claro">
                    Cancelar
                </a>
            </form>
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