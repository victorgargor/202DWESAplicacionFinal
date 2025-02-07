<?php
/**
 * Archivo principal de control de la aplicación.
 * Inicializa las configuraciones necesarias, maneja la sesión y carga la página actual.
 * 
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */

// Incluye la configuración de la aplicación
require_once 'config/confApp.php';

/**
 * Incluye la configuración de la base de datos.
 * Este archivo contiene las credenciales y configuraciones necesarias para la conexión a la base de datos.
 */
require_once 'config/confDB.php'; 

/**
 * Inicia la sesión o recupera la sesión existente.
 * La sesión es utilizada para mantener el estado de la aplicación entre peticiones.
 */
session_start(); 

/**
 * Verifica si no hay una página en curso en la sesión.
 * Si no existe, asigna la página de inicio pública como la página en curso.
 */
if (!isset($_SESSION['paginaEnCurso'])) { 
    $_SESSION['paginaEnCurso'] = 'inicioPublico'; 
}

/**
 * Carga el controlador correspondiente según la página en curso.
 * La variable $_SESSION['paginaEnCurso'] contiene el nombre del controlador a cargar.
 */
require_once $aControladores[$_SESSION['paginaEnCurso']]; 

