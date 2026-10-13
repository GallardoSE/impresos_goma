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

$titulo_pagina = "Agregar usuario - Panel administrativo - Impresos Goma";
include("../../includes/header_admin.php");
?>

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
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="grupo-formulario">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <div class="grupo-formulario">
                <label for="password">Contraseña</label>
                <input type="text" id="password" name="password" required>
            </div>

            <div class="grupo-formulario">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="administrador">Administrador</option>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
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

<?php include("../../includes/footer_admin.php"); ?>