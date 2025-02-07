<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */

/**
 * Interfaz UsuarioDB
 * 
 * Define la estructura que debe implementar cualquier clase que gestione la validación de usuarios en la base de datos.
 */
interface UsuarioDB {

    /**
     * Valida un usuario a partir de su código y contraseña.
     * 
     * Este método debe ser implementado por una clase que interactúe con la base de datos para verificar si el usuario 
     * con el código y la contraseña proporcionados existe y es válido.
     *
     * @param string $codUsuario Código del usuario a validar.
     * @param string $password Contraseña del usuario a validar.
     * 
     * @return bool `true` si el usuario y la contraseña son correctos, `false` en caso contrario.
     */
    public static function validarUsuario($codUsuario, $password);
}
