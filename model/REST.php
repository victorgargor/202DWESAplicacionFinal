<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */

/**
 * Clase REST
 * 
 * Esta clase proporciona métodos estáticos para interactuar con las APIs externas,
 * como la API de la NASA y la API de Chuck Norris. Permite obtener información de la NASA,
 * como las fotos del día, y obtener bromas de Chuck Norris, ya sea aleatorias o por categoría.
 */
class REST {

    /**
     * Clave API para acceder a la API de NASA.
     */
    const apikeyNASA = 'G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa';

    /**
     * Obtiene la foto del día de la NASA para una fecha específica.
     * 
     * Llama a la API de NASA y obtiene una foto del día correspondiente a la fecha dada.
     * Si la respuesta de la API contiene los datos requeridos, devuelve una instancia de la clase `FotoNasa`.
     * En caso contrario, retorna `null`.
     *
     * @param string $fecha Fecha en formato 'YYYY-MM-DD' para obtener la foto correspondiente.
     * @return FotoNasa|null Una instancia de la clase `FotoNasa` con los datos obtenidos, o `null` si no se encuentran datos.
     */
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
    
    /**
     * Obtiene una broma de Chuck Norris.
     * 
     * Si se pasa una categoría, se obtiene una broma específica de esa categoría. Si no,
     * se obtiene una broma aleatoria.
     * 
     * @param string|null $categoria La categoría de la broma (opcional).
     * @return string La broma de Chuck Norris obtenida.
     */
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

