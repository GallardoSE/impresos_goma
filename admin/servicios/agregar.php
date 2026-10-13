<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$mensaje = "";

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

    $sql = "INSERT INTO servicios 
            (nombre_servicio, descripcion, imagen, id_categoria, estado)
            VALUES 
            ('$nombre_servicio', '$descripcion', '$imagen', '$id_categoria', '$estado')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al guardar el servicio: " . $conexion->error;
    }
}

$titulo_pagina = "Agregar servicio - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

<section class="seccion">
    <div class="contenedor">
        <h2 class="titulo-seccion">Agregar servicio</h2>

        <p class="texto-seccion">
            Registra un nuevo servicio para mostrarlo en el catálogo público.
        </p>

        <?php if ($mensaje != "") { ?>
            <div class="mensaje-error">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>

        <form class="formulario" method="POST" action="agregar.php">
            <div class="grupo-formulario">
                <label for="nombre_servicio">Nombre del servicio</label>
                <input type="text" id="nombre_servicio" name="nombre_servicio" required>
            </div>

            <div class="grupo-formulario">
                <label for="id_categoria">Categoría</label>
                <select id="id_categoria" name="id_categoria" required>
                    <option value="">Selecciona una categoría</option>

                    <?php while ($categoria = $categorias->fetch_assoc()) { ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>">
                            <?php echo htmlspecialchars($categoria['nombre_categoria']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>

            <div class="grupo-formulario">
                <label for="imagen">Nombre de imagen</label>
                <input 
                    type="text" 
                    id="imagen"
                    name="imagen" 
                    placeholder="Ejemplo: playera_bordado.jpg"
                >
                <p class="nota-login">
                    La imagen debe estar guardada manualmente en assets/img/servicios/.
                </p>
            </div>

            <div class="grupo-formulario">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <button type="submit" class="boton-principal">
                Guardar servicio
            </button>

            <a href="index.php" class="boton-secundario-claro">
                Cancelar
            </a>
        </form>
    </div>
</section>

<?php include("../../includes/footer_admin.php"); ?>