<?php
/**
 * Controlador de gestión de errores de la aplicación.
 * 
 * Este script maneja la visualización de errores almacenados en la sesión y permite al usuario 
 * regresar a la página anterior si pulsa el botón "volver".
 * 
 * @author Víctor García Gordón
 * @version 10/01/2025
 */

// Guardamos el objeto ErrorApp almacenado en la sesión en una variable para que la vista pueda trabajar con él.
/** 
 * Objeto que contiene la información del error ocurrido.
 * 
 * @var ErrorApp $oError
 */
$oError = $_SESSION['error'];

// Si se pulsa el botón "volver", redirigimos a la ventana desde la que el usuario accedió al error.
if (isset($_REQUEST['volver'])) {
    /**
     * Página a la que se redirige tras pulsar "volver".
     * 
     * @var string $_SESSION['paginaEnCurso']
     */
    $_SESSION['paginaEnCurso'] = $oError->getPaginaSiguiente();
    
    // Redirecciona a la página principal del login y finaliza la ejecución del script.
    header('Location: indexLoginLogoff.php');
    exit();
}

/**
 * Datos de la vista que contienen la información del error.
 * 
 * @var array<string, mixed> $datosVista
 */
$datosVista = [
    'error' => $codError = $_SESSION['error']->getCodError(),
    'descripcion' => $descError = $_SESSION['error']->getDescError(),
    'archivo' => $archivoError = $_SESSION['error']->getArchivoError(),
    'linea' => $lineaError = $_SESSION['error']->getLineaError(),
];

// Carga la vista general de la aplicación.
require_once $aVistas['layout'];
