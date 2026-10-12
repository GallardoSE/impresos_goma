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

$id_servicio = intval($_GET["id"]);

// En vez de borrar definitivamente, se desactiva.
// Así evitamos errores si el servicio ya está relacionado con cotizaciones o galería.
$sql = "UPDATE servicios 
        SET estado = 0 
        WHERE id_servicio = $id_servicio";

$conexion->query($sql);

header("Location: index.php");
exit;
?>