<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../login.php");
    exit;
}

include("../../config/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO usuarios (nombre, correo, password, rol, estado)
            VALUES ('$nombre', '$correo', '$password', '$rol', '$estado')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al guardar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar usuario - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Agregar usuario administrador</p>
        </div>

        <nav class="menu">
            <a href="../panel.php">Panel</a>
            <a href="../categorias/index.php">Categorías</a>
            <a href="../servicios/index.php">Servicios</a>
            <a href="../cotizaciones/index.php">Cotizaciones</a>
            <a href="index.php">Usuarios</a>
            <a href="../../logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main>
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Agregar usuario administrador</h2>

            <p class="texto-seccion">
                Registra un nuevo usuario con acceso al panel administrativo.
            </p>

            <?php if ($mensaje != "") { ?>
                <div class="mensaje-error">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form class="formulario" method="POST" action="agregar.php">
                <div class="grupo-formulario">
                    <label>Nombre completo</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="grupo-formulario">
                    <label>Correo</label>
                    <input type="email" name="correo" required>
                </div>

                <div class="grupo-formulario">
                    <label>Contraseña</label>
                    <input type="text" name="password" required>
                </div>

                <div class="grupo-formulario">
                    <label>Rol</label>
                    <select name="rol" required>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="boton-principal">
                    Guardar usuario
                </button>

                <a href="index.php" class="boton-secundario-claro">
                    Cancelar
                </a>
            </form>
        </div>
    </section>
</main>

<footer class="pie">
    <div class="pie-copy">
        <p>&copy; 2026 Impresos Goma. Panel administrativo.</p>
    </div>
</footer>

</body>
</html>