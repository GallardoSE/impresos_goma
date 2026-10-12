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

// Evitar que el administrador elimine su propio usuario mientras está conectado
if ($id_usuario == $_SESSION["id_usuario"]) {
    header("Location: index.php");
    exit;
}

// No se borra definitivamente, solo se desactiva
$sql = "UPDATE usuarios 
        SET estado = 0 
        WHERE id_usuario = $id_usuario";

$conexion->query($sql);

header("Location: index.php");
exit;
?>