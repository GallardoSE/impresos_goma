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

$id_servicio = intval($_GET["id"]);
$mensaje = "";

$sql_servicio = "SELECT * FROM servicios WHERE id_servicio = $id_servicio";
$resultado_servicio = $conexion->query($sql_servicio);

if ($resultado_servicio->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$servicio = $resultado_servicio->fetch_assoc();

$sql_categorias = "SELECT id_categoria, nombre_categoria 
                   FROM categorias 
                   WHERE estado = 1 
                   ORDER BY nombre_categoria";

$categorias = $conexion->query($sql_categorias);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_servicio = $_POST["nombre_servicio"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_POST["imagen"];
    $id_categoria = $_POST["id_categoria"];
    $estado = $_POST["estado"];

    $sql = "UPDATE servicios SET
                nombre_servicio = '$nombre_servicio',
                descripcion = '$descripcion',
                imagen = '$imagen',
                id_categoria = '$id_categoria',
                estado = '$estado'
            WHERE id_servicio = $id_servicio";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al actualizar el servicio: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar servicio - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Editar servicio</p>
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
            <h2 class="titulo-seccion">Editar servicio</h2>

            <p class="texto-seccion">
                Modifica los datos del servicio seleccionado.
            </p>

            <?php if ($mensaje != "") { ?>
                <div class="mensaje-error">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form class="formulario" method="POST" action="editar.php?id=<?php echo $id_servicio; ?>">
                <div class="grupo-formulario">
                    <label>Nombre del servicio</label>
                    <input 
                        type="text" 
                        name="nombre_servicio" 
                        value="<?php echo $servicio['nombre_servicio']; ?>" 
                        required
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Categoría</label>
                    <select name="id_categoria" required>
                        <?php while ($categoria = $categorias->fetch_assoc()) { ?>
                            <option 
                                value="<?php echo $categoria['id_categoria']; ?>"
                                <?php if ($servicio["id_categoria"] == $categoria["id_categoria"]) echo "selected"; ?>
                            >
                                <?php echo $categoria['nombre_categoria']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4"><?php echo $servicio['descripcion']; ?></textarea>
                </div>

                <div class="grupo-formulario">
                    <label>Nombre de imagen</label>
                    <input 
                        type="text" 
                        name="imagen" 
                        value="<?php echo $servicio['imagen']; ?>"
                        placeholder="Ejemplo: serigrafia.jpg"
                    >
                    <p class="nota-login">
                        La imagen debe estar guardada manualmente en assets/img/servicios/.
                    </p>
                </div>

                <div class="grupo-formulario">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="1" <?php if ($servicio["estado"] == 1) echo "selected"; ?>>
                            Activo
                        </option>
                        <option value="0" <?php if ($servicio["estado"] == 0) echo "selected"; ?>>
                            Inactivo
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