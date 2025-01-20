<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body> 
    <div class="descripcion-usuario">     
        <?php echo($oUsuarioActivo->getDescUsuario()); ?>
    </div>
    <p id="mensaje-bienvenida">
        <?php
            // Mostrar el mensaje de bienvenida
            echo $mensaje;
        ?>
    </p>
    <form action="" method="POST">
        <input type="submit" name="cerrarsesion" value="Cerrar Sesión">
    </form>
    <form action="" method="POST">
        <input type="submit" name="detalle" value="Detalle">
    </form>
    <form action="" method="POST">
        <input type="submit" name="error" value="Error">
    </form>
    <form action="" method="POST">
        <input type="submit" name="mtodepartamentos" value="MToDepartamentos">
    </form>
     <form action="" method="POST">
        <input type="submit" name="rest" value="REST">
    </form>
</body>
</html>
