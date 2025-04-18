<?php
require_once __DIR__ . '/../config/conexion.php';

class CursosDAO {
    public static function obtenerTodos() {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM cursos ORDER BY fecha_inicio DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertar($curso) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO cursos (titulo, descripcion, publico_objetivo, fecha_inicio, fecha_fin, cupos) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $curso->titulo,
            $curso->descripcion,
            $curso->publico_objetivo,
            $curso->fecha_inicio,
            $curso->fecha_fin,
            $curso->cupos
        ]);
    }

    public static function obtenerPorId($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM cursos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($curso) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE cursos SET titulo = ?, descripcion = ?, publico_objetivo = ?, fecha_inicio = ?, fecha_fin = ?, cupos = ? WHERE id = ?");
        return $stmt->execute([
            $curso->titulo,
            $curso->descripcion,
            $curso->publico_objetivo,
            $curso->fecha_inicio,
            $curso->fecha_fin,
            $curso->cupos,
            $curso->id
        ]);
    }

    public static function eliminar($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM cursos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
