<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */

/**
 * Verifica si se ha solicitado volver a la página anterior
 * Si es así, establece la página en curso como 'inicioPrivado' y carga el controlador correspondiente.
 */
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Inicializa un array para almacenar los resultados de las APIs.
 * Este array contiene un índice 'nasa' que almacenará el título y foto de la NASA.
 */
$aVistaRest = [
    'nasa' => [], // Array para almacenar la información de la NASA (título y foto)
];

/**
 * Establece la fecha actual como la fecha en curso para la NASA (por defecto)
 * y la guarda en la sesión.
 */
$_SESSION['nasaFechaEnCurso'] = date("Y-m-d");

/**
 * Verifica si se ha enviado una fecha específica para la foto de la NASA.
 * Si es así, actualiza la fecha en curso de la NASA en la sesión.
 */
if (isset($_POST['fechaNasa'])) {
    $_SESSION['nasaFechaEnCurso'] = $_POST['fechaNasa'];
}

try {
    /**
     * Llama a la API de la NASA utilizando la fecha en curso almacenada en la sesión.
     * Si la respuesta es válida, se almacena el título y la URL de la foto.
     */
    $oFotoNasaEnCurso = REST::apiNasa($_SESSION['nasaFechaEnCurso']);

    if ($oFotoNasaEnCurso && is_object($oFotoNasaEnCurso)) {
        // Almacena el título de la foto obtenida de la API de la NASA
        $aVistaRest['nasa']['titulo'] = $oFotoNasaEnCurso->getTitulo();

        // Almacena la URL de la foto obtenida de la API de la NASA
        $aVistaRest['nasa']['foto'] = $oFotoNasaEnCurso->getFoto();
    } else {
        // Si la respuesta es nula, lanza una excepción
        throw new Exception('No se pudo obtener la información de la NASA.');
    }
} catch (Exception $e) {
    /**
     * Maneja el error capturado en caso de que la API de la NASA falle.
     * Crea un objeto de error y lo almacena en la sesión, luego redirige a la página de error.
     */
    $error = new ErrorApp(
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $_SESSION['paginaAnterior']
    );

    // Guarda el objeto ErrorApp en la sesión
    $_SESSION['error'] = $error;
    $_SESSION['paginaEnCurso'] = 'error';
    unset($_SESSION['nasaFechaEnCurso']);

    // Redirige a la página de error
    header('Location: indexLoginLogoff.php');
    exit();
}

/**
 * Verifica si se ha enviado un formulario con una categoría seleccionada.
 * Si es así, obtiene una broma de Chuck Norris correspondiente a esa categoría.
 * Si no, obtiene una broma aleatoria.
 */
if (isset($_POST['categoria'])) {
    // Obtiene la categoría seleccionada
    $categoria = $_POST['categoria'];
    $bromaChuck = REST::apiChuckNorris($categoria);
} else {
    // Si no se ha enviado una categoría, obtiene una broma aleatoria
    $bromaChuck = REST::apiChuckNorris();
}

/**
 * Almacena la broma obtenida de la API de Chuck Norris en el array de vista.
 */
$aVistaRest['chuckNorris']['broma'] = $bromaChuck;

/**
 * Incluye el archivo de vista, que se encuentra en el índice 'layout' del array $aVistas.
 */
require_once $aVistas['layout'];

