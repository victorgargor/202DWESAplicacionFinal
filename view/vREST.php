<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 23/01/2025 
 */
?>
<form class="position-absolute top-0 end-0" style="margin-top: -30px; margin-right: 15px" name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input class="btn btn-danger" name="volver" type="submit" value="Volver">
</form>

<div class="api-container">
    <!-- Sección 1: NASA API -->
    <div class="api-section nasa-section">
        <form name="formulario1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset class="nasa">
                <legend><h2>Foto del día de la NASA</h2></legend>
                <input type="date" name="fechaNasa" value="<?php echo isset($_SESSION['nasaFechaEnCurso']) ? $_SESSION['nasaFechaEnCurso'] : date("Y-m-d") ?>" max="<?php echo date('Y-m-d'); ?>" min="1999-01-01">
                <input type="submit" value="Pedir" name="nasa">
                <p><b>Título de la Imagen:</b> <?php echo isset($aVistaRest['nasa']['titulo']) ? $aVistaRest['nasa']['titulo'] : 'Título no disponible'; ?></p>
                <?php if (isset($aVistaRest['nasa']['foto'])) { ?>
                    <img src="<?php echo $aVistaRest['nasa']['foto']; ?>" width="300px" height="300px">
                <?php } else { ?>
                    <p>Imagen no disponible</p>
                <?php } ?>
                <hr>
                <p><b>URL:</b> https://api.nasa.gov/planetary/apod?api_key=API_KEY&date=$fecha</p>
                <p><b>Parámetros:</b> Fecha</p>
                <p><b>Método:</b> GET</p>
            </fieldset>
        </form>
    </div>

     <!-- Sección 2: AEMET API -->
    <div class="api-section aemet-section">
        <form name="formulario2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset class="aemet">
                <legend><h2>Predicción Meteorológica - AEMET</h2></legend>
                <label for="provincia">Selecciona la provincia:</label>
                <select name="provincia" id="provincia">
                    <option value="49" <?php echo (isset($_SESSION['AEMETProvincia']) && $_SESSION['AEMETProvincia'] == '49') ? 'selected' : ''; ?>>Zamora</option>
                    <option value="28" <?php echo (isset($_SESSION['AEMETProvincia']) && $_SESSION['AEMETProvincia'] == '28') ? 'selected' : ''; ?>>Madrid</option>
                    <option value="08" <?php echo (isset($_SESSION['AEMETProvincia']) && $_SESSION['AEMETProvincia'] == '08') ? 'selected' : ''; ?>>Barcelona</option>
                </select>
                <input type="submit" value="Pedir" name="aemet">
                <p><b>Predicción:</b> <?php echo isset($aVistaRest['AEMET']) ? $aVistaRest['AEMET'] : 'Predicción no disponible'; ?></p>
                <hr>
                <p><b>URL:</b> https://opendata.aemet.es/opendata/api/prediccion/provincia/hoy/{provincia}/?api_key=API_KEY</p>
                <p><b>Parámetros:</b> Código de Provincia</p>
                <p><b>Método:</b> GET</p>
            </fieldset>
        </form>
    </div>

    <!-- Sección 3: Vacía -->
    <div class="api-section"></div>
</div>

<form method="post">
    <input type="submit" name="volver" value="Volver">
</form>