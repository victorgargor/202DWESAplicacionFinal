<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025 
 */
if (isset($_SESSION['mensaje'])):
    ?>
    <p class="mensaje-exito"><?= $_SESSION['mensaje'] ?></p>
    <?php unset($_SESSION['mensaje']); ?> <!-- Eliminar el mensaje después de mostrarlo -->
<?php endif; ?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
    <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" style="background-color: lightyellow" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" style="background-color: lightyellow" required>
    </div>
    <div class="form-group">
        <input type="submit" name="iniciarsesion" value="Iniciar Sesión">
    </div>
    <div class="form-group">
        <input type="submit" name="registrarse" value="Registrarse">
    </div>
</form>
<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>
