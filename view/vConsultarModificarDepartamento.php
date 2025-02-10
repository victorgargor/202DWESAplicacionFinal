<?php
/**
 * Vista para consultar y modificar un departamento.
 * 
 * Muestra los datos del departamento seleccionado, permitiendo modificar 
 * la descripción y el volumen de negocio.
 * 
 * @author Víctor García Gordón
 * @version 10/02/2025
 */
?>

<header>      
    <h1 id="inicio">Editar Departamento</h1>
</header>

<!-- Mensaje de confirmación o error -->
<?php if (isset($mensaje)): ?>
    <p class="mensaje <?= strpos($mensaje, 'Error') === false ? 'mensaje-exito' : 'mensaje-error'; ?>">
        <?= $mensaje; ?>
    </p>
<?php endif; ?>

<!-- Formulario de modificación -->
<form method="post" class="consultar-departamento-form">
    <div class="form-group">
        <label for="codigo" class="form-label">Código:</label>
        <input style="width: 100px;" type="text" id="codigo" name="codigo" value="<?= $departamento->T02_CodDepartamento; ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input style="background-color: lightyellow; width: 250px;" type="text" id="descripcion" name="descripcion" value="<?= $departamento->T02_DescDepartamento; ?>" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="fechaAlta" class="form-label">Fecha de Alta:</label>
        <input style="width: 100px;" type="text" id="fechaAlta" name="fechaAlta" value="<?= date_format(new DateTime($departamento->T02_FechaCreacionDepartamento), 'd/m/Y'); ?>" class="form-input" readonly>
    </div>

    <div class="form-group">
        <label for="volumenDeNegocio" class="form-label">Volumen de Negocio (€):</label>
        <input style="background-color: lightyellow; width: 100px;" type="number" step="0.01" id="volumenDeNegocio" name="volumenDeNegocio" value="<?= $departamento->T02_VolumenDeNegocio; ?>" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="fechaBaja" class="form-label">Fecha de Baja:</label>
        <input style="width: 100px;" type="text" id="fechaBaja" name="fechaBaja" value="<?= $departamento->T02_FechaBajaDepartamento ? date_format(new DateTime($departamento->T02_FechaBajaDepartamento), 'd/m/Y') : 'Activo'; ?>" class="form-input" readonly>
    </div>

    <div class="form-actions">
        <button type="submit" name="guardar" class="form-button form-button-save">Aceptar</button>
        <button type="submit" name="volver" class="form-button form-button-cancel">Cancelar</button>
    </div>
</form>

