<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025 
 */

// Si se pulsa el botón volver
if (isset($_REQUEST['volver'])) {    
    // Asigno a la página en curso la página anterior
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    // Cierro la sesión 
    unset($_SESSION['error']);    
    // Redirijo al index
    header('Location: ../202DWESLoginLogoff/indexLoginLogoff.php'); 
    exit();
}
$datosVista = [
    'error' => $codError = $_SESSION['error']->getCodError(),
    'descripcion' => $descError = $_SESSION['error']->getDescError(),
    'archivo' => $archivoError = $_SESSION['error']->getArchivoError(),
    'linea' => $lineaError = $_SESSION['error']->getLineaError(),
];

require_once $aVistas['layout']; // Cargo la vista