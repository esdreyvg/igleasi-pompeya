<?php
require_once '../negocio/cursosControlador.php';

$accion = $_GET['accion'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['accion'] === 'crear') {
        CursosNegocio::registrar($_POST['titulo'], $_POST['descripcion'], $_POST['publico'], $_POST['inicio'], $_POST['fin'], $_POST['cupos']);
    } elseif ($_POST['accion'] === 'editar') {
        CursosNegocio::actualizar($_POST['id'], $_POST['titulo'], $_POST['descripcion'], $_POST['publico'], $_POST['inicio'], $_POST['fin'], $_POST['cupos']);
    }
    header("Location: cursos.php");
    exit;
}

if ($accion === 'eliminar' && $id) {
    CursosNegocio::eliminar($id);
    header("Location: cursos.php");
    exit;
}

$cursoEditar = ($accion === 'editar' && $id) ? CursosNegocio::obtener($id) : null;
$cursos = CursosNegocio::listar();
?>

<h2><?= $cursoEditar ? 'Editar Curso' : 'Registrar Curso' ?></h2>
<form method="POST">
    <input type="hidden" name="accion" value="<?= $cursoEditar ? 'editar' : 'crear' ?>">
    <?php if ($cursoEditar): ?>
        <input type="hidden" name="id" value="<?= $cursoEditar['id'] ?>">
    <?php endif; ?>
    Título: <input type="text" name="titulo" value="<?= $cursoEditar['titulo'] ?? '' ?>"><br>
    Público objetivo:
    <select name="publico">
        <?php
        $opciones = ['Niños', 'Adolescentes', 'Padres', 'Adultos'];
        foreach ($opciones as $op) {
            $sel = ($cursoEditar && $cursoEditar['publico_objetivo'] == $op) ? 'selected' : '';
            echo "<option value='$op' $sel>$op</option>";
        }
        ?>
    </select><br>
    Fecha Inicio: <input type="date" name="inicio" value="<?= $cursoEditar['fecha_inicio'] ?? '' ?>"><br>
    Fecha Fin: <input type="date" name="fin" value="<?= $cursoEditar['fecha_fin'] ?? '' ?>"><br>
    Cupos: <input type="number" name="cupos" value="<?= $cursoEditar['cupos'] ?? '' ?>"><br>
    Descripción:<br>
    <textarea name="descripcion"><?= $cursoEditar['descripcion'] ?? '' ?></textarea><br>
    <input type="submit" value="Guardar">
</form>

<h2>Listado de Cursos</h2>
<table border="1">
    <tr>
        <th>Título</th><th>Público</th><th>Inicio</th><th>Fin</th><th>Cupos</th><th>Acciones</th>
    </tr>
    <?php foreach ($cursos as $c): ?>
        <tr>
            <td><?= $c['titulo'] ?></td>
            <td><?= $c['publico_objetivo'] ?></td>
            <td><?= $c['fecha_inicio'] ?></td>
            <td><?= $c['fecha_fin'] ?></td>
            <td><?= $c['cupos'] ?></td>
            <td>
                <a href="?accion=editar&id=<?= $c['id'] ?>">Editar</a> |
                <a href="?accion=eliminar&id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar curso?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
