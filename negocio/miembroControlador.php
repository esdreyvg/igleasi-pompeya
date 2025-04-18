<?php
require_once __DIR__ . '/../datos/miembroDAO.php';
require_once './modelos/miembro.php';

class MiembroControlador {
    private $dao;

    public function __construct() {
        $this->dao = new MiembroDAO();
    }

    public function listarMiembros() {
        return $this->dao->obtenerTodos();
    }
    
    public function obtenerMiembro($id) {
        return $this->dao->obtenerPorId($id);
    }
    
    public function eliminarMiembro($id) {
        return $this->dao->eliminar($id);
    }

    public static function registrar($nombre, $direccion, $telefono) {
        $f = new Feligres();
        $f->nombre = $nombre;
        $f->direccion = $direccion;
        $f->telefono = $telefono;

        return FeligresesDAO::insertar($f);
    }

    public static function actualizar($id, $nombre, $direccion, $telefono) {
        $f = new Feligres();
        $f->id = $id;
        $f->nombre = $nombre;
        $f->direccion = $direccion;
        $f->telefono = $telefono;

        return FeligresesDAO::actualizar($f);
    }
}
?>
