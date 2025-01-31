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

        <h1 style="text-align: center; font-size: 2em; color: #2d2d2d; margin-top: 30px;">Foto del Día de la NASA</h1>

      
        <div style="text-align: center; margin-top: 20px;">
          
            <label for="fecha" style="font-size: 1.1em; margin-right: 10px; color: #333;">Selecciona una fecha:</label>
            <input type="date" id="fecha" name="fecha" style="padding: 8px; font-size: 1em; border-radius: 5px; border: 1px solid #ccc; margin-bottom: 20px;">

            <div id="error-message" style="color: red; font-weight: bold; margin-top: 20px;"></div>

            <div id="foto-container" style="display: flex; justify-content: center; margin-top: 20px;">
                <img id="foto" src="" alt="Foto del día" style="width: 200px; height: 200px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 20px;">
            </div>

            <div id="descripcion-container" style="display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 20px;">
                <div id="descripcion" style="font-size: 1.1em; color: #666; margin-top: 10px;">Aquí va la descripción de la imagen.</div>
            </div>
        </div>

        <script src="webroot/js/javascriptnasa.js"></script>
    </body>
</html>
