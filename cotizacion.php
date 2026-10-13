<?php
include("config/conexion.php");
include("includes/header.php");

// Consultar servicios activos para llenar el select
$sql_servicios = "SELECT id_servicio, nombre_servicio 
                  FROM servicios 
                  WHERE estado = 1 
                  ORDER BY nombre_servicio";

$servicios = $conexion->query($sql_servicios);

// Verificar si viene un servicio seleccionado desde catálogo o detalle
$servicio_seleccionado = "";

if (isset($_GET['servicio'])) {
    $servicio_seleccionado = intval($_GET['servicio']);
}
?>

<main id="contenido-principal">
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Solicitud de cotización</h2>

            <p class="texto-seccion">
                Completa los datos del servicio que necesitas. El administrador revisará la solicitud
                para preparar una cotización personalizada.
            </p>
            
            <?php if (isset($_GET['exito'])) { ?>
                <div class="mensaje-exito">
                    Solicitud enviada correctamente. El administrador revisará la información.
                </div>
            <?php } ?>

            <form class="formulario" action="guardar_cotizacion.php" method="POST">
                <div class="grupo-formulario">
                    <label>Nombre del cliente</label>
                    <input type="text" name="nombre_cliente" required>
                </div>

                <div class="grupo-formulario">
                    <label>Teléfono / WhatsApp</label>
                    <input type="text" name="telefono" required>
                </div>

                <div class="grupo-formulario">
                    <label>Correo electrónico</label>
                    <input type="email" name="correo">
                </div>

                <div class="grupo-formulario">
                    <label>Servicio solicitado</label>
                    <select name="id_servicio" required>
                        <option value="">Selecciona un servicio</option>

                        <?php while ($servicio = $servicios->fetch_assoc()) { ?>
                            <option 
                                value="<?php echo $servicio['id_servicio']; ?>"
                                <?php if ($servicio_seleccionado == $servicio['id_servicio']) echo "selected"; ?>
                            >
                                <?php echo $servicio['nombre_servicio']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" min="1" required>
                </div>

                <div class="grupo-formulario">
                    <label>Material o tipo de producto</label>
                    <input 
                        type="text" 
                        name="material" 
                        placeholder="Ejemplo: playera tipo polo, algodón, vinil, lona..."
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Descripción del diseño</label>
                    <textarea 
                        name="descripcion_diseno" 
                        rows="4" 
                        placeholder="Describe colores, ubicación del diseño, tamaño aproximado, texto, logotipo, etc."
                    ></textarea>
                </div>

                <div class="grupo-formulario">
                    <label>Fecha deseada de entrega</label>
                    <input type="date" name="fecha_entrega_deseada">
                </div>

                <div class="grupo-formulario">
                    <label>Comentarios adicionales</label>
                    <textarea 
                        name="comentarios" 
                        rows="4" 
                        placeholder="Agrega cualquier detalle adicional para la cotización."
                    ></textarea>
                </div>

                <button type="submit" class="boton-principal">
                    Enviar solicitud
                </button>
            </form>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>