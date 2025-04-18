<?php
require_once './datos/cursosDAO.php';
require_once './modelos/cursos.php';

class CursosNegocio {
    public static function listar() {
        return CursosDAO::obtenerTodos();
    }

    public static function registrar($titulo, $descripcion, $publico, $inicio, $fin, $cupos) {
        $c = new Curso();
        $c->titulo = $titulo;
        $c->descripcion = $descripcion;
        $c->publico_objetivo = $publico;
        $c->fecha_inicio = $inicio;
        $c->fecha_fin = $fin;
        $c->cupos = $cupos;
        return CursosDAO::insertar($c);
    }

    public static function obtener($id) {
        return CursosDAO::obtenerPorId($id);
    }

    public static function actualizar($id, $titulo, $descripcion, $publico, $inicio, $fin, $cupos) {
        $c = new Curso();
        $c->id = $id;
        $c->titulo = $titulo;
        $c->descripcion = $descripcion;
        $c->publico_objetivo = $publico;
        $c->fecha_inicio = $inicio;
        $c->fecha_fin = $fin;
        $c->cupos = $cupos;
        return CursosDAO::actualizar($c);
    }

    public static function eliminar($id) {
        return CursosDAO::eliminar($id);
    }
}
