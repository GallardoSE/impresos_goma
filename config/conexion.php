<?php
// Datos de conexión a MySQL en XAMPP
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "impresos_goma";

// Crear conexión usando mysqli
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar si hubo error de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar caracteres para aceptar acentos y ñ
$conexion->set_charset("utf8mb4");
?>