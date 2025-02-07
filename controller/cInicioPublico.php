<?php
/**
 * Configuración del idioma y redirección al login.
 * 
 * Este script gestiona la configuración del idioma mediante cookies y permite la redirección
 * a la página de login si el usuario lo solicita.
 * 
 * @author Víctor García Gordón
 * @version 19/12/2024
 */

/**
 * Si la cookie del idioma no está definida, se crea con el valor predeterminado 'es' (español).
 */
if (!isset($_COOKIE['idioma'])) {
    setcookie("idioma", "es", time() + 3600, "/"); // Expira en 1 hora
}

/**
 * Si se recibe una solicitud de cambio de idioma, se actualiza la cookie y se recarga la página.
 */
if (isset($_REQUEST['idioma'])) {
    setcookie("idioma", $_REQUEST['idioma'], time() + 60, "/"); // Expira en 1 minuto
    header('Location: ' . $_SERVER['PHP_SELF']); // Recarga la página actual
    exit();
}

/**
 * Si el usuario pulsa el botón de login, se redirige a la página de autenticación.
 */
if (isset($_REQUEST['login'])) {  
    $_SESSION['paginaEnCurso'] = 'login'; // Se asigna la página de login
    header('Location: indexLoginLogoff.php'); // Redirección al index
    exit();
}

/**
 * Carga la vista principal de la página pública.
 */
require_once $aVistas['layout'];
