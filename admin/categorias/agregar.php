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

$titulo_pagina = "Agregar categoría - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

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
                <label for="nombre_categoria">Nombre de la categoría</label>
                <input type="text" id="nombre_categoria" name="nombre_categoria" required>
            </div>

            <div class="grupo-formulario">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>

            <div class="grupo-formulario">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
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

<?php include("../../includes/footer_admin.php"); ?>