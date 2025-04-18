<?php
require_once __DIR__ . '/../negocio/MiembroControlador.php';

$accion = $_GET['accion'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['accion'] === 'crear') {
        MiembroControlador::registrar($_POST['nombre'], $_POST['direccion'], $_POST['telefono']);
    } elseif ($_POST['accion'] === 'editar') {
        MiembroControlador::actualizar($_POST['id'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono']);
    }
    header("Location: miembros.php");
    exit;
}

if ($accion === 'eliminar' && $id) {
    MiembroControlador::eliminar($id);
    header("Location: miembros.php");
    exit;
}

$feligresEditar = ($accion === 'editar' && $id) ? MiembroControlador::obtener($id) : null;
$feligreses = MiembroControlador::listar();
?>

<h2><?= $feligresEditar ? 'Editar Feligres' : 'Nuevo Feligres' ?></h2>
<form method="POST">
    <input type="hidden" name="accion" value="<?= $feligresEditar ? 'editar' : 'crear' ?>">
    <?php if ($feligresEditar): ?>
        <input type="hidden" name="id" value="<?= $feligresEditar['id'] ?>">
    <?php endif; ?>
    Nombre: <input type="text" name="nombre" value="<?= $feligresEditar['nombre'] ?? '' ?>"><br>
    Dirección: <input type="text" name="direccion" value="<?= $feligresEditar['direccion'] ?? '' ?>"><br>
    Teléfono: <input type="text" name="telefono" value="<?= $feligresEditar['telefono'] ?? '' ?>"><br>
    <input type="submit" value="Guardar">
</form>

<h2>Listado de Feligreses</h2>
<table border="1">
    <tr>
        <th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Acciones</th>
    </tr>
    <?php foreach ($feligreses as $f): ?>
        <tr>
            <td><?= $f['nombre'] ?></td>
            <td><?= $f['direccion'] ?></td>
            <td><?= $f['telefono'] ?></td>
            <td>
                <a href="?accion=editar&id=<?= $f['id'] ?>">Editar</a> |
                <a href="?accion=eliminar&id=<?= $f['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>