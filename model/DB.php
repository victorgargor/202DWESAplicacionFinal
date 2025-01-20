<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */

interface DB{
    public static function ejecutarConsulta($sentenciaSQL, $parametros);
}