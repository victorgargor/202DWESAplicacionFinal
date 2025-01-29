<?php
/**
 * @author Borja Nuñez Refoyo, reutilizado y mejorado por Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */
class REST {

    const apikeyNASA = 'G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa';

    public static function apiNasa($fecha) {
        try {
            // Validar que la fecha tenga el formato correcto
            if (!self::validarFecha($fecha)) {
                throw new Exception("Fecha inválida proporcionada para la API de la NASA.");
            }

            // Llama a la API de NASA con la fecha proporcionada como parámetro.
            $resultado = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=" . self::apikeyNASA . "&date=$fecha");

            // Si la respuesta es vacía o no se pudo obtener el contenido, lanzamos una excepción
            if ($resultado === false) {
                throw new Exception("Error al obtener los datos de la API de la NASA.");
            }

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

    // Función para validar el formato de la fecha
    private static function validarFecha($fecha) {
        $fechaValida = DateTime::createFromFormat('Y-m-d', $fecha);
        return $fechaValida && $fechaValida->format('Y-m-d') === $fecha;
    }
}
