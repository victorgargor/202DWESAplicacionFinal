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
            if (isset($archivoAPI)) {
                // Crea una instancia de la clase FotoNasa con los datos obtenidos de la API.
                $fotoNasa = new FotoNasa($archivoAPI['title'], $archivoAPI['url']);
                return $fotoNasa; // Retorna la instancia de FotoNasa.
            } else {
                // Si no hay datos válidos (por ejemplo, faltan 'title' o 'url'), retorna null.
                return null;
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
    }
    
    // Método para obtener una broma de Chuck Norris
    public static function apiChuckNorris($categoria = null) {
        try {
            // Si se pasa una categoría, obtenemos una broma de esa categoría.
            if ($categoria) {
                return ChuckNorrisAPI::obtenerBromaPorCategoria($categoria);
            } else {
                // Si no, obtenemos una broma aleatoria.
                return ChuckNorrisAPI::obtenerBromaAleatoria();
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
    }
}
