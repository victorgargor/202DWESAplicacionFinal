<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025 
 */
?>

<div class="container">
    <div class="text-center">
        <h1 class="error-header">¡ERROR!</h1>
        <p class="fs-3">Algo salió mal en la aplicación.</p>

        <div class="error-details">
            <p><strong>CÓDIGO:</strong> <?php echo $codError; ?></p>
            <p><strong>DESCRIPCIÓN:</strong> <?php echo $descError; ?></p>
            <p><strong>ARCHIVO:</strong> <?php echo $archivoError; ?></p>
            <p><strong>LÍNEA:</strong> <?php echo $lineaError; ?></p>
        </div>

        <form name="Programa" action="" method="post" class="mt-4">
            <button type="submit" class="btn btn-primary" name="volver">Volver</button>
        </form>
    </div>
</div>