<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025 
 */
// Si se pulsa el botón volver
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

$datosVista = [
    'error' => $codError = $_SESSION['error']->getCodError(),
    'descripcion' => $descError = $_SESSION['error']->getDescError(),
    'archivo' => $archivoError = $_SESSION['error']->getArchivoError(),
    'linea' => $lineaError = $_SESSION['error']->getLineaError(),
];

require_once $aVistas['layout']; // Cargo la vista