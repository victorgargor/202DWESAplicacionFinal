<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 15/01/2025 
 */

// Si se pulsa el botón volver
if (isset($_REQUEST['volver'])) {    
    // Asigno a la página en curso la página anterior
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];   
    // Redirijo al index
    header('Location: ../202DWESLoginLogoff/indexLoginLogoff.php'); 
    exit();
}

require_once $aVistas['layout']; // Cargo la vista