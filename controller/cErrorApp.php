<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025 
 */
//Guardamos el objeto ErrorApp almacenado en la sesion en un objeto para que la vista trabaje con el
$oError=$_SESSION['error'];

//Si se pulsa volver, redirigimos a la ventana desde la que el usuario accedio al error
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso']=$oError->getPaginaSiguiente();
    header('Location: indexLoginLogoff.php');
    exit();
}

$datosVista = [
    'error' => $codError = $_SESSION['error']->getCodError(),
    'descripcion' => $descError = $_SESSION['error']->getDescError(),
    'archivo' => $archivoError = $_SESSION['error']->getArchivoError(),
    'linea' => $lineaError = $_SESSION['error']->getLineaError(),
];

require_once $aVistas['layout']; // Cargo la vista