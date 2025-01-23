<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 23/01/2025 
 */
class REST {

    const apikeyNASA = 'G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa';

    public static function apiNasa($fecha) {
        try {
            // Llama a la API de NASA con la fecha proporcionada como parámetro.
            $resultado = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=" . self::apikeyNASA . "&date=$fecha");

            // Decodifica el resultado de la API desde formato JSON a un array asociativo de PHP.
            $archivoAPI = json_decode($resultado, true);

            // Verifica si el resultado contiene datos válidos.
            if (isset($archivoAPI)) {
                // Crea una instancia de la clase FotoNasa con los datos obtenidos de la API.
                $fotoNasa = new FotoNasa($archivoAPI['title'], $archivoAPI['url']);
                return $fotoNasa; // Retorna la instancia de FotoNasa.
            } else {
                // Si no hay datos válidos, retorna null.
                return null;
            }
        } catch (Exception $excepcion) {

            // Guarda la página actual en la sesión como la página anterior.
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];

            // Cambia la página en curso a una página de error.
            $_SESSION['paginaEnCurso'] = 'error';

            // Crea una nueva instancia de ErrorApp con los detalles de la excepción.
            $_SESSION['error'] = new ErrorApp($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine());

            // Redirige al usuario a la página de inicio en caso de error.
            header('Location:indexLoginLogoff.php');
            exit();
        }
    }
}
