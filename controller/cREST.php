<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */

// Si se pulsa volver
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Inicializa el array que almacenará los resultados de las APIs
$aVistaRest = [
    'nasa' => [], // Array para almacenar la información de la NASA (título y foto)
];

// Se establece la fecha actual como la fecha en curso para la NASA (por defecto)
if (!isset($_SESSION['nasaFechaEnCurso'])) {
    $_SESSION['nasaFechaEnCurso'] = date("Y-m-d");
}

// Verifica si se ha enviado una fecha específica para la foto de la NASA desde el formulario o la llamada AJAX
if (isset($_POST['fechaNasa'])) {
    // Si se ha enviado una fecha, la asigna como la nueva fecha en curso para la NASA
    $_SESSION['nasaFechaEnCurso'] = $_POST['fechaNasa'];
}

try {
    // Llama a la API de la NASA utilizando la fecha en curso de la NASA
    $oFotoNasaEnCurso = REST::apiNasa($_SESSION['nasaFechaEnCurso']);

    // Verifica que la respuesta no sea null antes de intentar acceder a sus métodos
    if ($oFotoNasaEnCurso !== null) {
        // Almacena el título de la foto obtenida de la API de la NASA
        $arrayVista['nasa']['titulo'] = $oFotoNasaEnCurso->getTitulo();

        // Almacena la URL de la foto obtenida de la API de la NASA
        $arrayVista['nasa']['foto'] = $oFotoNasaEnCurso->getFoto();
    } else {
        // Si la respuesta es null, lanzamos un error
        throw new Exception('No se pudo obtener la información de la NASA.');
    }
} catch (Exception $e) {
    // Manejo del error
    $error = new ErrorApp(
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $_SESSION['paginaAnterior']
    );
    // Guardamos el objeto ErrorApp en la sesión
    $_SESSION['error'] = $error;
    $_SESSION['paginaEnCurso'] = 'error';

    header('Location: indexLoginLogoff.php');
    exit();
}

// Incluyo la vista
require_once $aVistas['layout'];

