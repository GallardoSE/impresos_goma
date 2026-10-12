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

$id_categoria = intval($_GET["id"]);

// En lugar de borrar definitivamente, la categoría se desactiva.
// Esto evita errores si la categoría ya está relacionada con servicios.
$sql = "UPDATE categorias 
        SET estado = 0 
        WHERE id_categoria = $id_categoria";

$conexion->query($sql);

header("Location: index.php");
exit;
?>