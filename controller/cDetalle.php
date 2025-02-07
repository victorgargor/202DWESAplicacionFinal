<?php
/**
 * Archivo de control de redirección de página.
 * 
 * Este script maneja la redirección a la página del programa cuando se pulsa el botón "aceptar".
 * Si no se pulsa el botón, simplemente carga la vista de error.
 * 
 * @author Víctor García Gordón
 * @version 14/01/2025
 */

 // Verifica si se ha pulsado el botón "aceptar"
if (isset($_REQUEST['aceptar'])) {
    /**
     * Establece la página en curso a 'inicioPrivado'.
     * 
     * @var string $_SESSION['paginaEnCurso'] Página actual del usuario en la sesión.
     */
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';

    // Requiere el controlador correspondiente y finaliza la ejecución del script
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Carga la vista de 'layout'.
 * 
 * Este archivo contiene la estructura general de la aplicación.
 */
require_once $aVistas['layout'];
