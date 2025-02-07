<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */

/**
 * Interfaz DB
 * 
 * Define el contrato para las clases que implementen la conexión y ejecución de consultas en una base de datos.
 * Las clases que implementen esta interfaz deberán proporcionar una implementación del método `ejecutarConsulta`.
 */
interface DB {
    
    /**
     * Ejecuta una consulta SQL en la base de datos.
     *
     * @param string $sentenciaSQL La sentencia SQL que se desea ejecutar.
     * @param array $parametros Los parámetros a utilizar en la consulta SQL, si es necesario (por ejemplo, valores para una consulta preparada).
     * 
     * @return mixed El resultado de la consulta, que podría ser un conjunto de resultados, un valor de inserción, etc.
     */
    public static function ejecutarConsulta($sentenciaSQL, $parametros);
}
