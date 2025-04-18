<?php
require_once '../negocio/eventoControlador.php';

$accion = $_GET['accion'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['accion'] === 'crear') {
        EventosNegocio::registrar($_POST['nombre'], $_POST['fecha'], $_POST['hora'], $_POST['lugar'], $_POST['descripcion']);
    } elseif ($_POST['accion'] === 'editar') {
        EventosNegocio::actualizar($_POST['id'], $_POST['nombre'], $_POST['fecha'], $_POST['hora'], $_POST['lugar'], $_POST['descripcion']);
    }
    header("Location: eventos.php");
    exit;
}

if ($accion === 'eliminar' && $id) {
    EventosNegocio::eliminar($id);
    header("Location: eventos.php");
    exit;
}

$eventoEditar = ($accion === 'editar' && $id) ? EventosNegocio::obtener($id) : null;
$eventos = EventosNegocio::listar();
?>

<h2><?= $eventoEditar ? 'Editar Evento' : 'Registrar Evento' ?></h2>
<form method="POST">
    <input type="hidden" name="accion" value="<?= $eventoEditar ? 'editar' : 'crear' ?>">
    <?php if ($eventoEditar): ?>
        <input type="hidden" name="id" value="<?= $eventoEditar['id'] ?>">
    <?php endif; ?>
    Nombre: <input type="text" name="nombre" value="<?= $eventoEditar['nombre'] ?? '' ?>"><br>
    Fecha: <input type="date" name="fecha" value="<?= $eventoEditar['fecha'] ?? '' ?>"><br>
    Hora: <input type="time" name="hora" value="<?= $eventoEditar['hora'] ?? '' ?>"><br>
    Lugar: <input type="text" name="lugar" value="<?= $eventoEditar['lugar'] ?? '' ?>"><br>
    Descripción:<br>
    <textarea name="descripcion"><?= $eventoEditar['descripcion'] ?? '' ?></textarea><br>
    <input type="submit" value="Guardar">
</form>

<h2>Listado de Eventos</h2>
<table border="1">
    <tr>
        <th>Nombre</th><th>Fecha</th><th>Hora</th><th>Lugar</th><th>Descripción</th><th>Acciones</th>
    </tr>
    <?php foreach ($eventos as $e): ?>
        <tr>
            <td><?= $e['nombre'] ?></td>
            <td><?= $e['fecha'] ?></td>
            <td><?= $e['hora'] ?></td>
            <td><?= $e['lugar'] ?></td>
            <td><?= $e['descripcion'] ?></td>
            <td>
                <a href="?accion=editar&id=<?= $e['id'] ?>">Editar</a> |
                <a href="?accion=eliminar&id=<?= $e['id'] ?>" onclick="return confirm('¿Eliminar evento?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
