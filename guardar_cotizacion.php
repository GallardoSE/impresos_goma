<?php
include("config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre_cliente = $_POST["nombre_cliente"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $id_servicio = $_POST["id_servicio"];
    $cantidad = $_POST["cantidad"];
    $material = $_POST["material"];
    $descripcion_diseno = $_POST["descripcion_diseno"];
    $fecha_entrega_deseada = $_POST["fecha_entrega_deseada"];
    $comentarios = $_POST["comentarios"];

    $sql_cotizacion = "INSERT INTO cotizaciones 
        (nombre_cliente, telefono, correo, estado, mensaje_general)
        VALUES 
        ('$nombre_cliente', '$telefono', '$correo', 'Pendiente', '$comentarios')";

    if ($conexion->query($sql_cotizacion) === TRUE) {

        $id_cotizacion = $conexion->insert_id;

        $sql_detalle = "INSERT INTO detalle_cotizacion
            (id_cotizacion, id_servicio, cantidad, material, descripcion_diseno, fecha_entrega_deseada, comentarios)
            VALUES
            ('$id_cotizacion', '$id_servicio', '$cantidad', '$material', '$descripcion_diseno', '$fecha_entrega_deseada', '$comentarios')";

        if ($conexion->query($sql_detalle) === TRUE) {
            header("Location: cotizacion.php?exito=1");
            exit;
        } else {
            echo "Error al guardar el detalle de la cotización: " . $conexion->error;
        }

    } else {
        echo "Error al guardar la cotización: " . $conexion->error;
    }

} else {
    header("Location: cotizacion.php");
    exit;
}
?>