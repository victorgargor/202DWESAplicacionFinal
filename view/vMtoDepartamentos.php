<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */
?>
<!-- Formulario de búsqueda -->
<form class="busqueda" method="post">
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ''; ?>">
        <button type="submit" name="buscar">Buscar</button>
    </div>
</form>

<!-- Tabla de departamentos -->
<table border="1">
    <thead>
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Fecha Alta</th>
            <th>Volumen de Negocio</th>
            <th>Fecha Baja</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($departamentos)): ?>
            <tr>
                <td colspan="5">No se encontraron departamentos.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($departamentos as $oDepartamento): ?>
                <tr>
                    <td><?php echo $oDepartamento->T02_CodDepartamento; ?></td>
                    <td><?php echo $oDepartamento->T02_DescDepartamento; ?></td>
                    <td><?php echo date_format(new DateTime($oDepartamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?></td>
                    <td><?php echo number_format($oDepartamento->T02_VolumenDeNegocio, 2, '.', '.'); ?> €</td>
                    <td>
                        <?php echo $oDepartamento->T02_FechaBajaDepartamento ? date_format(new DateTime($oDepartamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <form method="post">
        <input type="submit" name="volver" value="Volver">
    </form>