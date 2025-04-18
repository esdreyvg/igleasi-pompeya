<?php
require_once __DIR__ . '/../config/conexion.php';

class SacramentosDAO {
    public static function obtenerTodos() {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT s.*, f.nombre as feligres_nombre FROM sacramentos s JOIN feligreses f ON s.feligres_id = f.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertar($sacramento) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO sacramentos (tipo, fecha, observaciones, feligres_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$sacramento->tipo, $sacramento->fecha, $sacramento->observaciones, $sacramento->feligres_id]);
    }

    public static function obtenerPorId($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM sacramentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($sacramento) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE sacramentos SET tipo = ?, fecha = ?, observaciones = ?, feligres_id = ? WHERE id = ?");
        return $stmt->execute([$sacramento->tipo, $sacramento->fecha, $sacramento->observaciones, $sacramento->feligres_id, $sacramento->id]);
    }

    public static function eliminar($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM sacramentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
