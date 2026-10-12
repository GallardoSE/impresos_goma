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

$id_usuario = intval($_GET["id"]);
$mensaje = "";

$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_usuario = $conexion->query($sql_usuario);

if ($resultado_usuario->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$usuario = $resultado_usuario->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];

    $sql = "UPDATE usuarios SET
                nombre = '$nombre',
                correo = '$correo',
                password = '$password',
                rol = '$rol',
                estado = '$estado'
            WHERE id_usuario = $id_usuario";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Error al actualizar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario - Panel administrativo</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado-contenido">
        <div class="logo-area">
            <h1>Panel administrativo</h1>
            <p>Editar usuario administrador</p>
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
            <h2 class="titulo-seccion">Editar usuario administrador</h2>

            <p class="texto-seccion">
                Modifica los datos del usuario seleccionado.
            </p>

            <?php if ($mensaje != "") { ?>
                <div class="mensaje-error">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form class="formulario" method="POST" action="editar.php?id=<?php echo $id_usuario; ?>">
                <div class="grupo-formulario">
                    <label>Nombre completo</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        value="<?php echo $usuario['nombre']; ?>" 
                        required
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Correo</label>
                    <input 
                        type="email" 
                        name="correo" 
                        value="<?php echo $usuario['correo']; ?>" 
                        required
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Contraseña</label>
                    <input 
                        type="text" 
                        name="password" 
                        value="<?php echo $usuario['password']; ?>" 
                        required
                    >
                </div>

                <div class="grupo-formulario">
                    <label>Rol</label>
                    <select name="rol" required>
                        <option value="administrador" <?php if ($usuario["rol"] == "administrador") echo "selected"; ?>>
                            Administrador
                        </option>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="1" <?php if ($usuario["estado"] == 1) echo "selected"; ?>>
                            Activo
                        </option>
                        <option value="0" <?php if ($usuario["estado"] == 0) echo "selected"; ?>>
                            Inactivo
                        </option>
                    </select>
                </div>

                <button type="submit" class="boton-principal">
                    Guardar cambios
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