<?php
include("config/conexion.php");
include("includes/header.php");

// Validar que venga un ID por la URL
if (!isset($_GET['id'])) {
    echo "<main><section class='seccion'><div class='contenedor'>";
    echo "<h2>Servicio no encontrado</h2>";
    echo "<p>No se recibió ningún servicio para mostrar.</p>";
    echo "<a href='catalogo.php' class='boton-principal'>Volver al catálogo</a>";
    echo "</div></section></main>";
    include("includes/footer.php");
    exit;
}

$id_servicio = intval($_GET['id']);

// Consulta JOIN para traer el servicio con su categoría
$sql = "SELECT 
            servicios.id_servicio,
            servicios.nombre_servicio,
            servicios.descripcion,
            servicios.imagen,
            categorias.nombre_categoria
        FROM servicios
        INNER JOIN categorias 
            ON servicios.id_categoria = categorias.id_categoria
        WHERE servicios.id_servicio = $id_servicio 
        AND servicios.estado = 1";

$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    echo "<main id='contenido-principal'><section class='seccion'><div class='contenedor'>";
    echo "<h2>Servicio no encontrado</h2>";
    echo "<p>El servicio solicitado no existe o no está disponible.</p>";
    echo "<a href='catalogo.php' class='boton-principal'>Volver al catálogo</a>";
    echo "</div></section></main>";
    include("includes/footer.php");
    exit;
}

$servicio = $resultado->fetch_assoc();
?>

<main id="contenido-principal">
    <section class="seccion">
        <div class="contenedor detalle-servicio">
            <div class="detalle-imagen">
                <img 
                    src="assets/img/servicios/<?php echo $servicio['imagen']; ?>" 
                    alt="<?php echo $servicio['nombre_servicio']; ?>"
                >
            </div>

            <div class="detalle-info">
                <span class="categoria-servicio">
                    <?php echo $servicio['nombre_categoria']; ?>
                </span>

                <h2><?php echo $servicio['nombre_servicio']; ?></h2>

                <p>
                    <?php echo $servicio['descripcion']; ?>
                </p>

                <div class="nota-cotizacion">
                    <h3>Cotización personalizada</h3>
                    <p>
                        El precio puede variar según cantidad, material, diseño,
                        tamaño del trabajo y fecha requerida.
                    </p>
                </div>

                <div class="acciones-servicio">
                    <a 
                        href="cotizacion.php?servicio=<?php echo $servicio['id_servicio']; ?>" 
                        class="boton-principal"
                    >
                        Solicitar cotización
                    </a>

                    <a href="catalogo.php" class="boton-secundario-claro">
                        Volver al catálogo
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>