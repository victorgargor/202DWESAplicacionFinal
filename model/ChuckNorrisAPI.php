<?php
/**
 * Clase para interactuar con la API de Chuck Norris Jokes.
 * @author Víctor García Gordón
 * @version Fecha de última modificación 06/02/2025
 */
class ChuckNorrisAPI {
    const API_URL = 'https://api.chucknorris.io/jokes/';

    // Categorías válidas conocidas
    private static $categoriasValidas = ['dev', 'animal', 'celebrity'];

    /**
     * Verifica si la categoría es válida.
     * @param string $categoria La categoría de la broma.
     * @return bool True si la categoría es válida, de lo contrario false.
     */
    public static function esCategoriaValida($categoria) {
        return in_array($categoria, self::$categoriasValidas);
    }

    /**
     * Obtiene una broma aleatoria de Chuck Norris.
     * @return string La broma de Chuck Norris.
     */
    public static function obtenerBromaAleatoria() {
        try {
            // Llamada a la API de Chuck Norris para obtener una broma aleatoria.
            $resultado = file_get_contents(self::API_URL . 'random');
            $broma = json_decode($resultado, true);

            if (isset($broma['value'])) {
                return $broma['value']; // Retorna la broma si está disponible.
            } else {
                throw new Exception("No se pudo obtener la broma.");
            }
        } catch (Exception $e) {
            // Manejo del error en caso de que falle la solicitud a la API.
            throw new Exception("Error al conectar con la API de Chuck Norris: " . $e->getMessage());
        }
    }

    /**
     * Obtiene una broma de Chuck Norris basada en una categoría específica.
     * @param string $categoria La categoría de la broma.
     * @return string La broma de Chuck Norris de esa categoría.
     */
    public static function obtenerBromaPorCategoria($categoria) {
        try {
            // Verificar si la categoría es válida antes de hacer la solicitud.
            if (!self::esCategoriaValida($categoria)) {
                throw new Exception("Categoría no válida: " . $categoria);
            }

            // Llamada a la API de Chuck Norris para obtener una broma por categoría.
            $resultado = file_get_contents(self::API_URL . 'random?category=' . urlencode($categoria));
            $broma = json_decode($resultado, true);

            if (isset($broma['value'])) {
                return $broma['value']; // Retorna la broma si está disponible.
            } else {
                throw new Exception("No se pudo obtener la broma para la categoría: " . $categoria);
            }
        } catch (Exception $e) {
            // Manejo del error en caso de que falle la solicitud a la API.
            throw new Exception("Error al conectar con la API de Chuck Norris: " . $e->getMessage());
        }
    }
}


