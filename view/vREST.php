<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 23/01/2025 
 */
?>
<header>      
    <h1 id="inicio">REST</h1>
</header>
<div class="api-container">
    <!-- Sección 1: NASA API -->
    <div class="api-section nasa-section">
        <fieldset class="nasa">
            <legend><h2>Foto del día de la NASA</h2></legend>
            <input type="date" id="fechaNasa" name="fechaNasa" value="<?php echo isset($_SESSION['nasaFechaEnCurso']) ? $_SESSION['nasaFechaEnCurso'] : date("Y-m-d") ?>" max="<?php echo date('Y-m-d'); ?>" min="1999-01-01">
            
            <p><b>Título de la Imagen:</b> <?php echo isset($aVistaRest['nasa']['titulo']) ? $aVistaRest['nasa']['titulo'] : 'Título no disponible'; ?></p>
            
            <?php if (isset($aVistaRest['nasa']['foto']) && !empty($aVistaRest['nasa']['foto'])) { ?>
                <img id="nasaImage" src="<?php echo $aVistaRest['nasa']['foto']; ?>" width="300px" height="300px" alt="Imagen del día de la NASA">
            <?php } else { ?>
                <p>Imagen no disponible</p>
            <?php } ?>
            <hr>
            <p><b>Instrucciones de uso:</b> <a target="blank" href=" https://api.nasa.gov"> https://api.nasa.gov</a></p>
            <p><b>URL:</b> https://api.nasa.gov/planetary/apod?api_key=API_KEY&date=<?php echo $_SESSION['nasaFechaEnCurso']; ?></p>
            <p><b>Parámetros:</b> Fecha</p>
            <p><b>Método:</b> GET</p>
        </fieldset>
    </div>
    <script src="webroot/js/nasa.js"></script>
</div>

<!-- Sección 2: CHUCK NORRIS API -->
<div class="api-section chuck-section">
    <fieldset class="chuck-norris">
        <legend><h2>Broma de Chuck Norris</h2></legend>
        <!-- Mostrar la broma de Chuck Norris -->
        <p><b>Broma:</b> <?php echo isset($aVistaRest['chuckNorris']['broma']) ? $aVistaRest['chuckNorris']['broma'] : 'Broma no disponible'; ?></p>

        <!-- Opción para elegir categoría de la broma -->
        <form method="post">
            <label for="categoria">Elige una categoría:</label>
            <select id="categoria" name="categoria">
                <option value="dev">Desarrolladores</option>
                <option value="animal">Animales</option>
                <option value="celebrity">Celebridades</option>
                <option value="extranet">Extranets</option>
            </select>
            <input type="submit" value="Obtener Broma">
        </form>
        <p><b>Instrucciones de uso:</b> <a target="blank" href="https://api.chucknorris.io/"> https://api.chucknorris.io/</a></p>
    </fieldset>
</div>

<!-- Sección 3: Vacía -->
<div class="api-section"></div>
</div>

<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>