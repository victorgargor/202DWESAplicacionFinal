<?php
/**
 * Vista para eliminar un departamento.
 * 
 * Muestra los datos del departamento en modo solo lectura con la opción de confirmar o cancelar la eliminación.
 * 
 * @author Víctor García Gordón
 * @version 13/02/2025
 */
?>
<header>
    <h1 id="inicio">Eliminar Departamento</h1>
</header>

<!-- Mensaje de error si ocurre alguno -->
<?php if (isset($mensaje)): ?>
    <p class="mensaje <?= strpos($mensaje, 'Error') === false ? 'mensaje-exito' : 'mensaje-error'; ?>">
        <?= $mensaje; ?>
    </p>
<?php endif; ?>

<!-- Formulario de eliminación -->
<form method="post" class="consultar-departamento-form">
    <div class="form-group">
        <label for="codigo" class="form-label">Código:</label>
        <input style="width: 100px;" type="text" id="codigo" name="codigo" value="<?= $departamento->T02_CodDepartamento; ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input style="width: 250px;" type="text" id="descripcion" name="descripcion" value="<?= $departamento->T02_DescDepartamento; ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="fechaAlta" class="form-label">Fecha de Alta:</label>
        <input style="width: 100px;" type="text" id="fechaAlta" name="fechaAlta" value="<?= date_format(new DateTime($departamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="volumenDeNegocio" class="form-label">Volumen de Negocio (€):</label>
        <input style="width: 100px;" type="number" step="0.01" id="volumenDeNegocio" name="volumenDeNegocio" value="<?= $departamento->T02_VolumenDeNegocio; ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="fechaBaja" class="form-label">Fecha de Baja:</label>
        <input style="width: 100px;" type="text" id="fechaBaja" name="fechaBaja" value="<?= $departamento->T02_FechaBajaDepartamento ? date_format(new DateTime($departamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>" class="form-input" readonly>
    </div>

    <div class="form-actions">
        <button type="submit" name="confirmarEliminar" class="form-button form-button-delete">Aceptar</button>
        <button type="submit" name="cancelar" class="form-button form-button-cancel">Cancelar</button>
    </div>
</form>
