<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 15/01/2025
 */

/**
 * Verifica si se ha pulsado el botón "volver".
 * Si es así, restablece la página en curso a la página anterior y redirige al usuario.
 */
if (isset($_REQUEST['volver'])) {
    // Establece la página en curso como la página anterior almacenada en la sesión
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];

    // Redirige al usuario a la página de login o logoff
    header('Location: indexLoginLogoff.php');
    exit();
}

/**
 * Incluye la vista correspondiente a la página en curso.
 * El archivo de la vista se obtiene desde el array $aVistas utilizando la clave 'layout'.
 */
require_once $aVistas['layout'];
