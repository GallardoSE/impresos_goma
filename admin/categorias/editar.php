<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id_categoria = intval($_GET["id"]);
$mensaje = "";

$sql_categoria = "SELECT * FROM categorias WHERE id_categoria = $id_categoria";
$resultado_categoria = $conexion->query($sql_categoria);

if ($resultado_categoria->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$categoria = $resultado_categoria->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = $_POST["nombre_categoria"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    $sql = "UPDATE categorias SET
                nombre_categoria = '$nombre_categoria',
                descripcion = '$descripcion',
                estado = '$estado'
            WHERE id_categoria = $id_categoria";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al actualizar la categoría: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar categoría - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Editar categoría</p>
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
            <h2 class="titulo-seccion">Editar categoría</h2>

            <p class="texto-seccion">
                Modifica los datos de la categoría seleccionada.
            </p>

            <?php if ($mensaje != "") { ?>
                <div class="mensaje-error">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form class="formulario" method="POST" action="editar.php?id=<?php echo $id_categoria; ?>">
                <div class="grupo-formulario">
                    <label>Nombre de la categoría</label>
                    <input 
                        type="text" 
                        name="nombre_categoria" 
                        value="<?php echo $categoria['nombre_categoria']; ?>" 
                        required
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4"><?php echo $categoria['descripcion']; ?></textarea>
                </div>

                <div class="grupo-formulario">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="1" <?php if ($categoria["estado"] == 1) echo "selected"; ?>>
                            Activa
                        </option>
                        <option value="0" <?php if ($categoria["estado"] == 0) echo "selected"; ?>>
                            Inactiva
                        </option>
                    </select>
                </div>

                <button type="submit" class="boton-principal">
                    Guardar cambios
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