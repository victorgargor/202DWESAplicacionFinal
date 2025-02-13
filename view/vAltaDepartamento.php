<?php
/**
 * Vista para añadir un nuevo departamento.
 * 
 * @author Víctor García Gordón
 * @version 14/02/2025
 */
?>
<header>
    <h1>Añadir Departamento</h1>
</header>

<!-- Mensaje de error o confirmación -->
<?php if (!empty($mensaje)): ?>
    <p class="mensaje <?= strpos($mensaje, 'Error') === false ? 'mensaje-exito' : 'mensaje-error'; ?>">
        <?= htmlspecialchars($mensaje); ?>
    </p>
<?php endif; ?>

<!-- Formulario de alta de departamento -->
<form method="post" class="consultar-departamento-form" novalidate>
    <div class="form-group">
        <label for="codigo" class="form-label">Código:</label>
        <input type="text" id="codigo" name="codigo" class="form-input"
               style="width: 100px; background-color: lightyellow;"
               maxlength="3" required>
        <span class="error"><?= $aErrores['codigo'] ?? ''; ?></span>
    </div>

    <div class="form-group">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" class="form-input"
               style="width: 250px; background-color: lightyellow;"
               value="<?= isset($_REQUEST['descripcion']) ? htmlspecialchars($_REQUEST['descripcion']) : ''; ?>"
               required>
        <span class="error"><?= $aErrores['descripcion'] ?? ''; ?></span>
    </div>

    <div class="form-group">
        <label for="volumenDeNegocio" class="form-label">Volumen de Negocio (€):</label>
        <input type="number" step="0.01" id="volumenDeNegocio" name="volumenDeNegocio" class="form-input"
               style="width: 100px; background-color: lightyellow;"
               value="<?= isset($_REQUEST['volumenDeNegocio']) ? htmlspecialchars($_REQUEST['volumenDeNegocio']) : ''; ?>"
               required>
        <span class="error"><?= $aErrores['volumenDeNegocio'] ?? ''; ?></span>
    </div>

    <div class="form-actions">
        <button type="submit" name="guardar" class="form-button form-button-save">Aceptar</button>
        <button type="submit" name="volver" class="form-button form-button-cancel">Cancelar</button>
    </div>
</form>
