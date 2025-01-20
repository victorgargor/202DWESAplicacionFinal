<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */

// Incluyo la configuracion de la App
require_once 'config/confApp.php';

// Incluyo la configuracion de la DB
require_once 'config/confDB.php'; 

// Creo la sesión o recupero la anterior
session_start(); 

// Si no hay una pagina en curso dentro de la sesión
if(!isset($_SESSION['paginaEnCurso'])){ 
    // Asigno a la pagina en curso la pagina de InicioPublico
    $_SESSION['paginaEnCurso'] = 'inicioPublico'; 
}

// Cargo la pagina 
require_once $aControladores[$_SESSION['paginaEnCurso']]; 