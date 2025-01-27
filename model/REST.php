<?php

/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 23/01/2025 
 */
class REST {

    const apikeyNASA = 'G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa';
    const apikeyAEMET = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjb2dvcmRlcm9zdmljdG9yaW5vQGdtYWlsLmNvbSIsImp0aSI6ImRiZWZiMzg1LWFmNDgtNDkwYi04ZWJmLTk3NGVlYzRlMTMxNiIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzM3OTc3OTc4LCJ1c2VySWQiOiJkYmVmYjM4NS1hZjQ4LTQ5MGItOGViZi05NzRlZWM0ZTEzMTYiLCJyb2xlIjoiIn0.RuY4PDRA-uV1IpFoeDN_n6AIc3LXN-e2Ur1Xj36VNg0';

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

    public static function apiAemet($provincia) {
        try {
            // Obtenemos el resultado de la API REST de AEMET para la provincia especificada
            $resultado = file_get_contents("https://opendata.aemet.es/opendata/api/prediccion/provincia/hoy/{$provincia}/?api_key=" . self::apikeyAEMET);

            // Decodificamos el JSON obtenido desde la API en un array asociativo
            $archivoApi = json_decode($resultado, true);

            // Verificamos si el array contiene información
            if (isset($archivoApi)) {
                // Creamos una instancia de la clase PrediccionAemet con los datos recibidos
                $tiempoAemet = new AEMET ($archivoApi['datos']);

                // Retornamos la instancia que contiene la predicción del tiempo
                return $tiempoAemet;
            } else {
                // Si el array no contiene datos, devolvemos null
                return null;
            }
        } catch (Exception $excepcion) {
            // Guarda la página actual en la sesión como la página anterior.
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
            
            // Cambia la página en curso a una página de error.
            $_SESSION['paginaEnCurso'] = 'error';

            // Creamos una instancia de ErrorApp con los detalles del error
            $_SESSION['error'] = new ErrorApp($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine());

            // Redirige al usuario a la página de inicio en caso de error
            header('Location:indexLoginLogoff.php');
            exit(); 
        }
    }
}
