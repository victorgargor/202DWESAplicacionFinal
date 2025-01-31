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
<table style="width: 1000px; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
    <thead>
        <tr>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Código</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Descripción</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Fecha Alta</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Volumen de Negocio</th>
            <th style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f6f8fa; font-weight: 600;">Fecha Baja</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($departamentos)): ?>
            <tr>
                <td colspan="5" style="padding: 10px; text-align: center; border: 1px solid #e1e4e8; background-color: #f9f9f9;">No se encontraron departamentos.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($departamentos as $oDepartamento): ?>
                <tr>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo $oDepartamento->T02_CodDepartamento; ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo $oDepartamento->T02_DescDepartamento; ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo date_format(new DateTime($oDepartamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?></td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;"><?php echo number_format($oDepartamento->T02_VolumenDeNegocio, 2, '.', '.'); ?> €</td>
                    <td style="padding: 8px; text-align: center; border: 1px solid #e1e4e8;">
                        <?php echo $oDepartamento->T02_FechaBajaDepartamento ? date_format(new DateTime($oDepartamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>