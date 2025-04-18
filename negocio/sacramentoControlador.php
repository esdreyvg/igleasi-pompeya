<?php
require_once './datos/sacramentoDAO.php';
require_once './modelos/sacramentos.php';

class SacramentosNegocio {
    public static function listar() {
        return SacramentosDAO::obtenerTodos();
    }

    public static function registrar($tipo, $fecha, $observaciones, $feligres_id) {
        $s = new Sacramento();
        $s->tipo = $tipo;
        $s->fecha = $fecha;
        $s->observaciones = $observaciones;
        $s->feligres_id = $feligres_id;

        return SacramentosDAO::insertar($s);
    }

    public static function obtener($id) {
        return SacramentosDAO::obtenerPorId($id);
    }

    public static function actualizar($id, $tipo, $fecha, $observaciones, $feligres_id) {
        $s = new Sacramento();
        $s->id = $id;
        $s->tipo = $tipo;
        $s->fecha = $fecha;
        $s->observaciones = $observaciones;
        $s->feligres_id = $feligres_id;

        return SacramentosDAO::actualizar($s);
    }

    public static function eliminar($id) {
        return SacramentosDAO::eliminar($id);
    }
}
