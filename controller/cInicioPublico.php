<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */

// Si la cookie está vacia se crea y se le pone un valor por defecto
if (!isset($_COOKIE['idioma'])) {
    setcookie("idioma", "es", time() + 3600, "/");
}

// Si el idioma enviado está vacio o es null
if (isset($_REQUEST['idioma'])) {
    setcookie("idioma", $_REQUEST['idioma'], time() + 60, "/");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Redirige a la página de login si se pulsa el botón
if (isset($_REQUEST['login'])) {  
    $_SESSION['paginaEnCurso'] = 'login'; // Asigno la pagina de login
    header('Location: indexLoginLogoff.php');// Redirige al index
    exit();
}

// Cargo la vInicioPublico
require_once $aVistas['layout'];