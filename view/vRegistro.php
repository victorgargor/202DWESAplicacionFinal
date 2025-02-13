<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 29/01/2025 
 */
?>
<header>      
    <h1 id="inicio">Registro</h1>
</header>
<form class="registro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
    <div class="form-group">
        <label for="codigo">Usuario:</label><br>
        <input type="text" id="codigo" name="codigo" style="background-color: lightyellow" value="<?php echo isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : ''; ?>" required>
        <?php if (!empty($aErrores['codigo'])): ?>
            <p class="error"><?= $aErrores['codigo'] ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" style="background-color: lightyellow" required>
        <?php if (!empty($aErrores['password'])): ?>
            <p class="error"><?= $aErrores['password'] ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label><br>
        <input type="text" id="descripcion" name="descripcion" style="background-color: lightyellow" required>
        <?php if (!empty($aErrores['descripcion'])): ?>
            <p class="error"><?= $aErrores['descripcion'] ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <input type="submit" name="registrarse" value="Registrarse">
    </div>
</form>
<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>
