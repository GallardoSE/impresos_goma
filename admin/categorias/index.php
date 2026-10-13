<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$sql = "SELECT * FROM categorias ORDER BY id_categoria DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Panel administrativo - Impresos Goma</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/impresos_goma/assets/img/logo_Impresos_Goma.png">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="/impresos_goma/assets/css/estilos.css">
</head>
<body>

<a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <a href="/impresos_goma/admin/panel.php" title="Ir al panel">
                <img src="/impresos_goma/assets/img/logo_Impresos_Goma.png" alt="Logo Impresos Goma" class="logo-img">
            </a>
            <div>
                <h1>Panel administrativo</h1>
                <p>Gestión de categorías</p>
            </div>
        </div>

        <nav class="menu" aria-label="Navegación del panel">
            <a href="/impresos_goma/admin/panel.php">Panel</a>
            <a href="/impresos_goma/admin/categorias/index.php">Categorías</a>
            <a href="/impresos_goma/admin/servicios/index.php">Servicios</a>
            <a href="/impresos_goma/admin/cotizaciones/index.php">Cotizaciones</a>
            <a href="/impresos_goma/admin/usuarios/index.php">Usuarios</a>
            <a href="/impresos_goma/index.php" target="_blank" title="Ver sitio público">Ver Sitio ↗</a>
            <a href="/impresos_goma/logout.php">Cerrar sesión</a>

            <!-- Switch Modo Oscuro (I / O) -->
            <div class="switch-theme-container">
                <button id="theme-toggle" class="switch-btn" role="switch" aria-checked="false" aria-label="Cambiar entre modo claro u oscuro">
                    <span class="switch-text">I</span>
                    <span class="switch-thumb"></span>
                    <span class="switch-text">O</span>
                </button>
            </div>
        </nav>
    </div>
</header>

<main id="contenido-principal">
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Categorías</h2>

            <p class="texto-seccion">
                Desde esta sección se administran las categorías usadas para organizar los servicios.
            </p>

            <a href="agregar.php" class="boton-principal">Agregar categoría</a>

            <div class="tabla-contenedor">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($categoria = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $categoria["id_categoria"]; ?></td>
                                <td><?php echo $categoria["nombre_categoria"]; ?></td>
                                <td><?php echo $categoria["descripcion"]; ?></td>
                                <td>
                                    <?php 
                                    if ($categoria["estado"] == 1) {
                                        echo "Activa";
                                    } else {
                                        echo "Inactiva";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $categoria["id_categoria"]; ?>" class="accion-editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $categoria["id_categoria"]; ?>" class="accion-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>

<footer class="pie">
    <div class="pie-copy">
        <p>&copy; <?php echo date('Y'); ?> Impresos Goma. Panel administrativo.</p>
    </div>
</footer>

<!-- Botón Flotante de WhatsApp -->
<a href="https://wa.me/5213223831899?text=Hola%20Impresos%20Goma,%20soporte%20del%20sistema" 
   class="btn-whatsapp" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Contactar por WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="logo-wa-svg">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
    </svg>
</a>

<!-- Botón Volver Arriba -->
<button id="btn-volver-arriba" class="btn-arriba" aria-label="Volver arriba">↑</button>

<script>
  // --- MODO OSCURO ACCESIBLE ---
  const toggleBtn = document.getElementById('theme-toggle');
  const currentTheme = localStorage.getItem('theme');

  function aplicarTema(tema) {
    if (tema === 'dark') {
      document.documentElement.setAttribute('data-theme', 'dark');
      if (toggleBtn) toggleBtn.setAttribute('aria-checked', 'true');
    } else {
      document.documentElement.setAttribute('data-theme', 'light');
      if (toggleBtn) toggleBtn.setAttribute('aria-checked', 'false');
    }
  }

  if (currentTheme) {
    aplicarTema(currentTheme);
  }

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      let temaActual = document.documentElement.getAttribute('data-theme');
      let nuevoTema = (temaActual === 'dark') ? 'light' : 'dark';
      
      aplicarTema(nuevoTema);
      localStorage.setItem('theme', nuevoTema);
    });
  }

  // --- BOTÓN VOLVER ARRIBA ---
  const btnArriba = document.getElementById('btn-volver-arriba');
  window.addEventListener('scroll', () => {
    if (btnArriba) {
      btnArriba.style.display = window.scrollY > 100 ? 'flex' : 'none';
    }
  });

  btnArriba?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>

</body>
</html>