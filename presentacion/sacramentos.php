<?php
require_once '../negocio/sacramentoControlador.php';
require_once '../negocio/miembroControlador.php';

$accion = $_GET['accion'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['accion'] === 'crear') {
        SacramentosNegocio::registrar($_POST['tipo'], $_POST['fecha'], $_POST['observaciones'], $_POST['feligres_id']);
    } elseif ($_POST['accion'] === 'editar') {
        SacramentosNegocio::actualizar($_POST['id'], $_POST['tipo'], $_POST['fecha'], $_POST['observaciones'], $_POST['feligres_id']);
    }
    header("Location: sacramentos.php");
    exit;
}

if ($accion === 'eliminar' && $id) {
    SacramentosNegocio::eliminar($id);
    header("Location: sacramentos.php");
    exit;
}

$sacramentoEditar = ($accion === 'editar' && $id) ? SacramentosNegocio::obtener($id) : null;
$sacramentos = SacramentosNegocio::listar();
$feligreses = MiembroControlador::listar();
?>

<h2><?= $sacramentoEditar ? 'Editar Sacramento' : 'Registrar Sacramento' ?></h2>
<form method="POST">
    <input type="hidden" name="accion" value="<?= $sacramentoEditar ? 'editar' : 'crear' ?>">
    <?php if ($sacramentoEditar): ?>
        <input type="hidden" name="id" value="<?= $sacramentoEditar['id'] ?>">
    <?php endif; ?>
    Tipo:
    <select name="tipo">
        <?php
        $tipos = ['Bautismo', 'Primera Comunión', 'Confirmación', 'Matrimonio'];
        foreach ($tipos as $tipo) {
            $selected = $sacramentoEditar && $sacramentoEditar['tipo'] == $tipo ? 'selected' : '';
            echo "<option value='$tipo' $selected>$tipo</option>";
        }
        ?>
    </select><br>
    Fecha: <input type="date" name="fecha" value="<?= $sacramentoEditar['fecha'] ?? '' ?>"><br>
    Feligres:
    <select name="feligres_id">
        <?php foreach ($feligreses as $f): ?>
            <option value="<?= $f['id'] ?>" <?= $sacramentoEditar && $sacramentoEditar['feligres_id'] == $f['id'] ? 'selected' : '' ?>>
                <?= $f['nombre'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    Observaciones:<br>
    <textarea name="observaciones"><?= $sacramentoEditar['observaciones'] ?? '' ?></textarea><br>
    <input type="submit" value="Guardar">
</form>

<h2>Listado de Sacramentos</h2>
<table border="1">
    <tr>
        <th>Tipo</th><th>Fecha</th><th>Feligres</th><th>Observaciones</th><th>Acciones</th>
    </tr>
    <?php foreach ($sacramentos as $s): ?>
        <tr>
            <td><?= $s['tipo'] ?></td>
            <td><?= $s['fecha'] ?></td>
            <td><?= $s['feligres_nombre'] ?></td>
            <td><?= $s['observaciones'] ?></td>
            <td>
                <a href="?accion=editar&id=<?= $s['id'] ?>">Editar</a> |
                <a href="?accion=eliminar&id=<?= $s['id'] ?>" onclick="return confirm('¿Eliminar sacramento?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
