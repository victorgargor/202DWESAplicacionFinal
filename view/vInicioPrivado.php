<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */
?>
<header>      
    <h1 id="inicio">Inicio Privado</h1>
</header>
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

    <h1 style="text-align: center; font-size: 2em; color: #2d2d2d; margin-top: 30px;">Foto de la NASA con JavaScript</h1>

    <div style="text-align: center; margin-top: 20px;">
        <div id="error-message" style="color: red; font-weight: bold; margin-top: 20px;"></div>

        <div id="foto-container" style="display: flex; justify-content: center; margin-top: 20px;">
            <img id="foto" src="" alt="Foto del día" style="width: 210px; height: 210px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 20px;">
        </div>

        <div id="descripcion-container" style="display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 20px;">
            <div id="descripcion" style="font-size: 1.1em; color: #666; margin-top: 10px;">Aquí va la descripción de la imagen.</div>
        </div>
    </div>

    <script src="webroot/js/javascriptnasa.js"></script>
</body>

