<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 15/01/2025 
 */


// Si se pulsa el botón volver
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

require_once $aVistas['layout']; // Cargo la vista