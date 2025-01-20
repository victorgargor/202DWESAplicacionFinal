<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */

interface UsuarioDB {
    public static function validarUsuario($codUsuario, $password);
}