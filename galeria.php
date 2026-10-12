<?php
include("config/conexion.php");
include("includes/header.php");

$sql = "SELECT 
            galeria.titulo,
            galeria.descripcion,
            galeria.imagen,
            servicios.nombre_servicio
        FROM galeria
        LEFT JOIN servicios 
            ON galeria.id_servicio = servicios.id_servicio
        WHERE galeria.estado = 1
        ORDER BY galeria.id_imagen DESC";

$resultado = $conexion->query($sql);
?>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Galería de trabajos</h2>

            <p class="texto-seccion">
                Algunos ejemplos de trabajos relacionados con impresión, serigrafía, bordado, rotulación y personalización.
            </p>

            <div class="grid-catalogo">
                <?php if ($resultado->num_rows > 0) { ?>
                    <?php while ($imagen = $resultado->fetch_assoc()) { ?>
                        <div class="card-servicio">
                            <div class="imagen-servicio">
                                <img 
                                    src="assets/img/galeria/<?php echo $imagen['imagen']; ?>" 
                                    alt="<?php echo $imagen['titulo']; ?>"
                                >
                            </div>

                            <div class="contenido-servicio">
                                <span class="categoria-servicio">
                                    <?php echo $imagen['nombre_servicio']; ?>
                                </span>

                                <?php if (!empty($imagen['descripcion'])) { ?>
                                    <p><?php echo $imagen['descripcion']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="contacto-card">
                        <h3>Galería pendiente</h3>
                        <p>
                            Aún no hay imágenes registradas. El administrador puede agregarlas después
                            escribiendo el nombre del archivo guardado en assets/img/galeria/.
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>