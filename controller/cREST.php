<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 23/01/2025 
 */

// Si se pulsa el botón 'volver'
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    // Se establece la fecha actual como la fecha en curso de la NASA
    $_SESSION['nasaFechaEnCurso'] = date("Y-m-d");
    exit(); 
}

// Inicializa el array que almacenará los resultados de las APIs
$aVistaRest = [
    'nasa' => [], // Array para almacenar la información de la NASA (título y foto)
    'AEMET' => '', // Cadena vacía para almacenar la previsión de AEMET (por ahora no se utiliza)
    'departamento' => []  // Array vacío para almacenar la información del departamento
];

// Se establece la fecha actual como la fecha en curso para la NASA (por defecto)
$_SESSION['nasaFechaEnCurso'] = date("Y-m-d");

// Verifica si se ha enviado una fecha específica para la foto de la NASA desde el formulario
if (isset($_REQUEST['fechaNasa'])) {
    // Si se ha enviado una fecha, la asigna como la nueva fecha en curso para la NASA
    $_SESSION['nasaFechaEnCurso'] = $_REQUEST['fechaNasa'];
}

try {
    // Llama a la API de la NASA utilizando la fecha en curso de la NASA
    $oFotoNasaEnCurso = REST::apiNasa($_SESSION['nasaFechaEnCurso']);

    // Verifica si la respuesta es válida
    if ($oFotoNasaEnCurso && is_object($oFotoNasaEnCurso)) {
        // Almacena el título de la foto obtenida de la API de la NASA
        $aVistaRest['nasa']['titulo'] = $oFotoNasaEnCurso->getTitulo();

        // Almacena la URL de la foto obtenida de la API de la NASA
        $aVistaRest['nasa']['foto'] = $oFotoNasaEnCurso->getFoto();
    } else {
        throw new Exception('La API de la NASA no devolvió datos válidos.');
    }
} catch (Exception $e) {
    // Manejo de errores: muestra el mensaje de error si algo salió mal con la API de la NASA
    error_log('Error al obtener los datos de la NASA: ' . $e->getMessage());
    $aVistaRest['nasa']['titulo'] = 'Error al cargar la información';
    $aVistaRest['nasa']['foto'] = ''; // Asigna una cadena vacía si ocurre un error
}

// Incluyo la vista
require_once $aVistas['layout'];
