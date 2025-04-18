<?php
require_once __DIR__ . '/../config/conexion.php';

class EventosDAO {
    public static function obtenerTodos() {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC, hora DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertar($evento) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO eventos (nombre, fecha, hora, lugar, descripcion) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$evento->nombre, $evento->fecha, $evento->hora, $evento->lugar, $evento->descripcion]);
    }

    public static function obtenerPorId($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM eventos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($evento) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE eventos SET nombre = ?, fecha = ?, hora = ?, lugar = ?, descripcion = ? WHERE id = ?");
        return $stmt->execute([$evento->nombre, $evento->fecha, $evento->hora, $evento->lugar, $evento->descripcion, $evento->id]);
    }

    public static function eliminar($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
