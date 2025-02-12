<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 12/02/2025
 */
?>
<header>
    <h1 id="inicio">
        <?= isset($modoVer) && $modoVer ? 'Ver Departamento' : 'Editar Departamento'; ?>
    </h1>
</header>
<!-- Mensaje de confirmación o error -->
<?php if (isset($mensaje)): ?>
    <p class="mensaje <?= strpos($mensaje, 'Error') === false ? 'mensaje-exito' : 'mensaje-error'; ?>">
        <?= $mensaje; ?>
    </p>
<?php endif; ?>

<!-- Formulario de modificación -->
<form method="post" class="consultar-departamento-form" novalidate>
    <div class="form-group">
        <label for="codigo" class="form-label">Código:</label>
        <input style="width: 100px;" type="text" id="codigo" name="codigo" value="<?= $departamento->T02_CodDepartamento; ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="descripcion" class="form-label">Descripción:</label>
        <!-- Si estamos en modo ver, no se aplica el color lightyellow -->
        <input style="width: 250px; <?= isset($modoVer) && $modoVer ? '' : 'background-color: lightyellow;' ?>" 
               type="text" id="descripcion" name="descripcion" value="<?= $departamento->T02_DescDepartamento; ?>" class="form-input" <?= isset($modoVer) && $modoVer ? 'readonly' : 'required' ?>>
    </div>

    <div class="form-group">
        <label for="fechaAlta" class="form-label">Fecha de Alta:</label>
        <input style="width: 100px;" type="text" id="fechaAlta" name="fechaAlta" value="<?= date_format(new DateTime($departamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="volumenDeNegocio" class="form-label">Volumen de Negocio (€):</label>
        <!-- Si estamos en modo ver, no se aplica el color lightyellow -->
        <input style="width: 100px; <?= isset($modoVer) && $modoVer ? '' : 'background-color: lightyellow;' ?>" 
               type="number" step="0.01" id="volumenDeNegocio" name="volumenDeNegocio" value="<?= $departamento->T02_VolumenDeNegocio; ?>" class="form-input" <?= isset($modoVer) && $modoVer ? 'readonly' : 'required' ?>>
    </div>

    <div class="form-group">
        <label for="fechaBaja" class="form-label">Fecha de Baja:</label>
        <input style="width: 100px;" type="text" id="fechaBaja" name="fechaBaja" value="<?= $departamento->T02_FechaBajaDepartamento ? date_format(new DateTime($departamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>" class="form-input" readonly>
    </div>

    <div class="form-actions">
        <?php if (isset($modoVer) && $modoVer): ?>
            <!-- Solo el botón "Aceptar" si estamos en el modo "ver" -->
            <button type="submit" name="volver" class="form-button form-button-cancel">Aceptar</button>
        <?php else: ?>
            <!-- Los botones de "Aceptar" y "Cancelar" si estamos en el modo "editar" -->
            <button type="submit" name="guardar" class="form-button form-button-save">Aceptar</button>
            <button type="submit" name="volver" class="form-button form-button-cancel">Cancelar</button>
        <?php endif; ?>
    </div>
</form>

