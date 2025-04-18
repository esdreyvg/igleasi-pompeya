<?php
require_once __DIR__ . '/../config/conexion.php';

class MiembroDAO {
    public function obtenerTodos() {
        $conn = obtenerConexion();
        $sql = "SELECT * FROM miembros";
        $resultado = $conn->query($sql);
        $miembros = [];

        while ($fila = $resultado->fetch_assoc()) {
            $miembros[] = $fila;
        }

        $conn->close();
        return $miembros;
    }
    
    public static function insertar($feligres) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO miembros (nombre, direccion, telefono) VALUES (?, ?, ?)");
        return $stmt->execute([$feligres->nombre, $feligres->direccion, $feligres->telefono]);
    }

    public static function obtenerPorId($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM miembros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($feligres) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE miembros SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?");
        return $stmt->execute([$feligres->nombre, $feligres->direccion, $feligres->telefono, $feligres->id]);
    }

    public static function eliminar($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM miembros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
