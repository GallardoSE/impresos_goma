<?php
include("config/conexion.php");
include("includes/header.php");

// Consulta JOIN para mostrar servicios junto con su categoría
$sql = "SELECT 
            servicios.id_servicio,
            servicios.nombre_servicio,
            servicios.descripcion,
            servicios.imagen,
            categorias.nombre_categoria
        FROM servicios
        INNER JOIN categorias 
            ON servicios.id_categoria = categorias.id_categoria
        WHERE servicios.estado = 1
        ORDER BY categorias.nombre_categoria, servicios.nombre_servicio";

$resultado = $conexion->query($sql);
?>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Catálogo de servicios</h2>

            <p class="texto-seccion">
                Consulta los principales servicios disponibles en Impresos Goma.
                Cada servicio puede solicitarse mediante cotización personalizada.
            </p>

            <div class="grid-catalogo">
                <?php while ($servicio = $resultado->fetch_assoc()) { ?>
                    <div class="card-servicio">
                        <div class="imagen-servicio">
                            <img 
                                src="assets/img/servicios/<?php echo $servicio['imagen']; ?>" 
                                alt="<?php echo $servicio['nombre_servicio']; ?>"
                            >
                        </div>

                        <div class="contenido-servicio">
                            <span class="categoria-servicio">
                                <?php echo $servicio['nombre_categoria']; ?>
                            </span>

                            <h3><?php echo $servicio['nombre_servicio']; ?></h3>

                            <p>
                                <?php echo $servicio['descripcion']; ?>
                            </p>

                            <div class="acciones-servicio">
                                <a 
                                    href="detalle_servicio.php?id=<?php echo $servicio['id_servicio']; ?>" 
                                    class="boton-secundario-claro"
                                >
                                    Ver detalle
                                </a>

                                <a 
                                    href="cotizacion.php?servicio=<?php echo $servicio['id_servicio']; ?>" 
                                    class="boton-principal"
                                >
                                    Cotizar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>