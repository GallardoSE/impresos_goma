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

$titulo_pagina = "Editar servicio - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

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
                <label for="nombre_servicio">Nombre del servicio</label>
                <input 
                    type="text" 
                    id="nombre_servicio"
                    name="nombre_servicio" 
                    value="<?php echo htmlspecialchars($servicio['nombre_servicio']); ?>" 
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label for="id_categoria">Categoría</label>
                <select id="id_categoria" name="id_categoria" required>
                    <?php while ($categoria = $categorias->fetch_assoc()) { ?>
                        <option 
                            value="<?php echo $categoria['id_categoria']; ?>"
                            <?php if ($servicio["id_categoria"] == $categoria["id_categoria"]) echo "selected"; ?>
                        >
                            <?php echo htmlspecialchars($categoria['nombre_categoria']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
            </div>

            <div class="grupo-formulario">
                <label for="imagen">Nombre de imagen</label>
                <input 
                    type="text" 
                    id="imagen"
                    name="imagen" 
                    value="<?php echo htmlspecialchars($servicio['imagen']); ?>"
                    placeholder="Ejemplo: serigrafia.jpg"
                >
                <p class="nota-login">
                    La imagen debe estar guardada manualmente en assets/img/servicios/.
                </p>
            </div>

            <div class="grupo-formulario">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
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

<?php include("../../includes/footer_admin.php"); ?>