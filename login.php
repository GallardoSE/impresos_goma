<?php
session_start();
include("config/conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios 
            WHERE correo = '$correo' 
            AND password = '$password' 
            AND estado = 1";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];

        header("Location: admin/panel.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}

include("includes/header.php");
?>

<main id="contenido-principal">
    <section class="seccion">
        <div class="contenedor">
            <h2 class="titulo-seccion">Inicio de sesión</h2>

            <p class="texto-seccion">
                Acceso exclusivo para administradores del sistema.
            </p>

            <?php if ($error != "") { ?>
                <div class="mensaje-error">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form class="formulario login-formulario" method="POST" action="login.php">
                <div class="grupo-formulario">
                    <label>Correo</label>
                    <input type="email" name="correo" required>
                </div>

                <div class="grupo-formulario">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="boton-principal">
                    Entrar
                </button>
            </form>

            <p class="nota-login">
                Usuario de prueba: admin@impresosgoma.com <br>
                Contraseña: 123456
            </p>
        </div>
    </section>
</main>

<?php
include("includes/footer.php");
?>