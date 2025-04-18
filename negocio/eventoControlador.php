<?php
require_once './datos/eventoDAO.php';
require_once './modelos/eventos.php';

class EventosNegocio {
    public static function listar() {
        return EventosDAO::obtenerTodos();
    }

    public static function registrar($nombre, $fecha, $hora, $lugar, $descripcion) {
        $e = new Evento();
        $e->nombre = $nombre;
        $e->fecha = $fecha;
        $e->hora = $hora;
        $e->lugar = $lugar;
        $e->descripcion = $descripcion;

        return EventosDAO::insertar($e);
    }

    public static function obtener($id) {
        return EventosDAO::obtenerPorId($id);
    }

    public static function actualizar($id, $nombre, $fecha, $hora, $lugar, $descripcion) {
        $e = new Evento();
        $e->id = $id;
        $e->nombre = $nombre;
        $e->fecha = $fecha;
        $e->hora = $hora;
        $e->lugar = $lugar;
        $e->descripcion = $descripcion;

        return EventosDAO::actualizar($e);
    }

    public static function eliminar($id) {
        return EventosDAO::eliminar($id);
    }
}
