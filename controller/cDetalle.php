<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 14/01/2025
 */

// Redirige a la página del programa si se pulsa el botón
if (isset($_REQUEST['aceptar'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

require_once $aVistas['layout']; // Cargo la vista de 'error'