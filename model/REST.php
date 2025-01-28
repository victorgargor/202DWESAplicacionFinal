<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025 
 */
class REST {

    const apikeyNASA = 'G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa';

    public static function apiNasa($fecha) {
        try {
            // Llama a la API de NASA con la fecha proporcionada como parámetro.
            $resultado = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=" . self::apikeyNASA . "&date=$fecha");

            // Decodifica el resultado de la API desde formato JSON a un array asociativo de PHP.
            $archivoAPI = json_decode($resultado, true);

            // Verifica si la respuesta contiene los campos 'title' y 'url'
            if (isset($archivoAPI['title']) && isset($archivoAPI['url'])) {
                // Crea una instancia de la clase FotoNasa con los datos obtenidos de la API.
                $fotoNasa = new FotoNasa($archivoAPI['title'], $archivoAPI['url']);
                return $fotoNasa; // Retorna la instancia de FotoNasa.
            } else {
                // Si no hay datos válidos (por ejemplo, faltan 'title' o 'url'), retorna null.
                return null;
            }
        } catch (Exception $excepcion) {
            // Manejo de excepciones: podrías hacer un log aquí si necesitas más detalles.
            error_log('Error al obtener datos de la API de NASA: ' . $excepcion->getMessage());

            // Redirige a una página de error si la API falla.
            $_SESSION['paginaEnCurso'] = 'error';
            $_SESSION['error'] = new ErrorApp($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine());

            header('Location: indexLoginLogoff.php');
            exit();
        }
    }
}
