<?php
include("includes/header.php");
?>

<main id="contenido-principal">
    <section class="hero">
    <div class="contenedor hero-contenido">
        <div class="hero-marca">
            <img src="assets/img/logo_Impresos_Goma.png" alt="Logo Impresos Goma" class="logo-hero">

            <div class="hero-texto">
                <h2>Impresos Goma</h2>
                <p>
                    Servicios de serigrafía, bordado, sublimación, rotulación,
                    vinil textil e impresión digital en Puerto Vallarta.
                </p>

                <div class="hero-botones">
                    <a href="catalogo.php" class="boton-principal">Ver servicios</a>
                    <a href="cotizacion.php" class="boton-secundario">Solicitar cotización</a>
                </div>
            </div>
        </div>

        <div class="hero-card">
            <h3>Catálogo centralizado</h3>
            <p>
                Consulta los servicios disponibles y solicita una cotización
                personalizada según cantidad, material y diseño.
            </p>
        </div>
    </div>
</section>

    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Servicios principales</h2>

            <div class="tarjetas">
                <div class="tarjeta">
                    <h3>Serigrafía</h3>
                    <p>Impresión personalizada para playeras, uniformes y artículos promocionales.</p>
                </div>

                <div class="tarjeta">
                    <h3>Bordado</h3>
                    <p>Personalización profesional para polos, gorras, camisas y uniformes.</p>
                </div>

                <div class="tarjeta">
                    <h3>Rotulación</h3>
                    <p>Rotulación vehicular, comercial y publicitaria para negocios.</p>
                </div>

                <div class="tarjeta">
                    <h3>Impresión digital</h3>
                    <p>Tarjetas, etiquetas, menús, vinil impreso y material publicitario.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion fondo-suave">
        <div class="contenedor bloque-info">
            <div>
                <h2>Solicita una cotización personalizada</h2>
                <p>
                    El precio puede variar según el tipo de trabajo, cantidad,
                    material, diseño y fecha requerida. Por eso el sistema permite
                    enviar una solicitud detallada al administrador.
                </p>
            </div>

            <a href="cotizacion.php" class="boton-principal">Cotizar ahora</a>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>