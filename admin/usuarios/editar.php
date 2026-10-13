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

$titulo_pagina = "Editar usuario - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

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
                <label for="nombre">Nombre completo</label>
                <input 
                    type="text" 
                    id="nombre"
                    name="nombre" 
                    value="<?php echo htmlspecialchars($usuario['nombre']); ?>" 
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label for="correo">Correo</label>
                <input 
                    type="email" 
                    id="correo"
                    name="correo" 
                    value="<?php echo htmlspecialchars($usuario['correo']); ?>" 
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label for="password">Contraseña</label>
                <input 
                    type="text" 
                    id="password"
                    name="password" 
                    value="<?php echo htmlspecialchars($usuario['password']); ?>" 
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="administrador" <?php if ($usuario["rol"] == "administrador") echo "selected"; ?>>
                        Administrador
                    </option>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
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

<?php include("../../includes/footer_admin.php"); ?>