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

$id_cotizacion = intval($_GET["id"]);
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estado = $_POST["estado"];

    $sql_actualizar = "UPDATE cotizaciones 
                       SET estado = '$estado'
                       WHERE id_cotizacion = $id_cotizacion";

    if ($conexion->query($sql_actualizar) === TRUE) {
        $mensaje = "Estado actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar el estado: " . $conexion->error;
    }
}

// Consulta especial JOIN para ver el detalle completo de la cotización
$sql = "SELECT 
            cotizaciones.id_cotizacion,
            cotizaciones.nombre_cliente,
            cotizaciones.telefono,
            cotizaciones.correo,
            cotizaciones.fecha_solicitud,
            cotizaciones.estado,
            cotizaciones.mensaje_general,
            detalle_cotizacion.cantidad,
            detalle_cotizacion.material,
            detalle_cotizacion.descripcion_diseno,
            detalle_cotizacion.fecha_entrega_deseada,
            detalle_cotizacion.comentarios,
            servicios.nombre_servicio,
            categorias.nombre_categoria
        FROM cotizaciones
        INNER JOIN detalle_cotizacion
            ON cotizaciones.id_cotizacion = detalle_cotizacion.id_cotizacion
        INNER JOIN servicios
            ON detalle_cotizacion.id_servicio = servicios.id_servicio
        INNER JOIN categorias
            ON servicios.id_categoria = categorias.id_categoria
        WHERE cotizaciones.id_cotizacion = $id_cotizacion";

$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$cotizacion = $resultado->fetch_assoc();

$titulo_pagina = "Detalle de cotización - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

<section class="seccion">
    <div class="contenedor">
        <h2 class="titulo-seccion">Detalle de cotización</h2>

        <?php if ($mensaje != "") { ?>
            <div class="mensaje-exito">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>

        <div class="detalle-admin">
            <h3>Datos del cliente</h3>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cotizacion["nombre_cliente"]); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($cotizacion["telefono"]); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($cotizacion["correo"]); ?></p>
            <p><strong>Fecha de solicitud:</strong> <?php echo htmlspecialchars($cotizacion["fecha_solicitud"]); ?></p>

            <hr>

            <h3>Datos del servicio solicitado</h3>
            <p><strong>Servicio:</strong> <?php echo htmlspecialchars($cotizacion["nombre_servicio"]); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($cotizacion["nombre_categoria"]); ?></p>
            <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($cotizacion["cantidad"]); ?></p>
            <p><strong>Material:</strong> <?php echo htmlspecialchars($cotizacion["material"]); ?></p>
            <p><strong>Descripción del diseño:</strong> <?php echo htmlspecialchars($cotizacion["descripcion_diseno"]); ?></p>
            <p><strong>Fecha deseada de entrega:</strong> <?php echo htmlspecialchars($cotizacion["fecha_entrega_deseada"]); ?></p>
            <p><strong>Comentarios:</strong> <?php echo htmlspecialchars($cotizacion["comentarios"]); ?></p>

            <hr>

            <h3>Estado de la solicitud</h3>

            <form class="formulario" method="POST" action="ver.php?id=<?php echo $id_cotizacion; ?>">
                <div class="grupo-formulario">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="Pendiente" <?php if ($cotizacion["estado"] == "Pendiente") echo "selected"; ?>>Pendiente</option>
                        <option value="En revisión" <?php if ($cotizacion["estado"] == "En revisión") echo "selected"; ?>>En revisión</option>
                        <option value="Cotizada" <?php if ($cotizacion["estado"] == "Cotizada") echo "selected"; ?>>Cotizada</option>
                        <option value="Finalizada" <?php if ($cotizacion["estado"] == "Finalizada") echo "selected"; ?>>Finalizada</option>
                        <option value="Cancelada" <?php if ($cotizacion["estado"] == "Cancelada") echo "selected"; ?>>Cancelada</option>
                    </select>
                </div>

                <button type="submit" class="boton-principal">
                    Guardar estado
                </button>

                <a href="index.php" class="boton-secundario-claro">
                    Volver
                </a>
            </form>
        </div>
    </div>
</section>

<?php include("../../includes/footer_admin.php"); ?>