<?php
function obtenerConexion() {
    $conexion = new mysqli('localhost', 'root', '', 'iglesia');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}
?>
