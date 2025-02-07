<?php

/**
 * Clase UsuarioPDO
 * Implementa la interfaz UsuarioDB para gestionar usuarios en la base de datos.
 * 
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */
class UsuarioPDO implements UsuarioDB {

    /**
     * Valida un usuario en la base de datos.
     * 
     * @param string $codUsuario Código de usuario.
     * @param string $password Contraseña del usuario.
     * @return Usuario|false Devuelve un objeto Usuario si es válido, o false si no se encuentra.
     * 
     * @author Jesús Ferreras González
     * @author Víctor García Gordón
     */
    #[\Override]
    public static function validarUsuario($codUsuario, $password) {
        $parametros = [
            ':codUsuario' => $codUsuario,
            ':password' => $codUsuario . $password
        ];
        
        $sql = <<<SQL
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = :codUsuario 
            AND T01_Password = sha2(:password, 256);
        SQL;

        $resultadoConsulta = DBPDO::ejecutarConsulta($sql, $parametros);

        if ($resultadoConsulta->rowCount() > 0) {
            $oResultadoConsulta = $resultadoConsulta->fetchObject();

            return new Usuario(
                $oResultadoConsulta->T01_CodUsuario,
                $oResultadoConsulta->T01_Password,
                $oResultadoConsulta->T01_DescUsuario,
                $oResultadoConsulta->T01_NumConexiones,
                $oResultadoConsulta->T01_FechaHoraUltimaConexion,
                isset($oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior) ? $oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior : null,
                $oResultadoConsulta->T01_Perfil,
                $oResultadoConsulta->T01_ImagenUsuario
            );
        } else {
            return false;
        }
    }

    /**
     * Da de alta un nuevo usuario en la base de datos.
     * 
     * @param string $codUsuario Código de usuario.
     * @param string $password Contraseña del usuario.
     * @param string $descUsuario Descripción del usuario.
     * @param string|null $imagenUsuario URL o datos de la imagen de perfil (opcional).
     * @return Usuario Retorna el objeto Usuario creado.
     * 
     * @author Jesús Ferreras González
     * @author Víctor García Gordón
     */
    public static function altaUsuario($codUsuario, $password, $descUsuario, $imagenUsuario = null) {
        $parametros = [
            ':codUsuario' => $codUsuario,
            ':password' => $codUsuario . $password,
            ':descUsuario' => $descUsuario,
            ':imagenUsuario' => $imagenUsuario
        ];
        
        $sql = <<<SQL
            INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_ImagenUsuario)
            VALUES (:codUsuario, sha2(:password, 256), :descUsuario, :imagenUsuario);
        SQL;

        DBPDO::ejecutarConsulta($sql, $parametros);

        $sql2 = <<<SQL
            SELECT * FROM T01_Usuario
            WHERE T01_CodUsuario = '$codUsuario';
        SQL;

        $datos = DBPDO::ejecutarConsulta($sql2)->fetchObject();

        return new Usuario(
            $datos->T01_CodUsuario,
            $datos->T01_Password,
            $datos->T01_DescUsuario,
            $datos->T01_NumConexiones,
            new DateTime($datos->T01_FechaHoraUltimaConexion),
            null,
            $datos->T01_Perfil,
            $datos->T01_ImagenUsuario,
            null
        );
    }

    /**
     * Modifica los datos de un usuario en la base de datos.
     * (Método aún no implementado).
     */
    public static function modificarUsuario() {
        // Implementación futura
    }

    /**
     * Borra un usuario de la base de datos.
     * (Método aún no implementado).
     */
    public static function borrarUsuario() {
        // Implementación futura
    }

    /**
     * Valida si un código de usuario ya existe en la base de datos.
     * 
     * @param string $codUsuario Código de usuario a verificar.
     * @return bool Devuelve true si el código ya existe, false en caso contrario.
     */
    public static function validarCodNoExiste($codUsuario) {
        $sql = <<<SQL
            SELECT COUNT(*) FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}';
        SQL;

        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);
        $registro = $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

        return $registro['COUNT(*)'] > 0;
    }

    /**
     * Registra la última conexión de un usuario en la base de datos.
     * 
     * @param string $codUsuario Código de usuario.
     * @return Usuario|null Devuelve un objeto Usuario actualizado o null si el usuario no existe.
     */
    public static function registrarUltimaConexion($codUsuario) {
        $fechaHoraActual = date('Y-m-d H:i:s');

        $sql = <<<SQL
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}';
        SQL;

        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);

        if ($resultadoConsulta->rowCount() > 0) {
            $oResultadoConsulta = $resultadoConsulta->fetchObject();

            $oUsuario = new Usuario(
                $oResultadoConsulta->T01_CodUsuario,
                $oResultadoConsulta->T01_Password,
                $oResultadoConsulta->T01_DescUsuario,
                $oResultadoConsulta->T01_NumConexiones,
                $oResultadoConsulta->T01_FechaHoraUltimaConexion,
                isset($oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior) ? $oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior : null,
                $oResultadoConsulta->T01_Perfil,
                $oResultadoConsulta->T01_ImagenUsuario
            );

            $oUsuario->setNumAccesos($oUsuario->getNumAccesos() + 1);
            $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());

            $sql2 = <<<SQL
                UPDATE T01_Usuario
                SET T01_NumConexiones = T01_NumConexiones + 1,
                    T01_FechaHoraUltimaConexion = '{$fechaHoraActual}'
                WHERE T01_CodUsuario = '{$codUsuario}';
            SQL;

            DBPDO::ejecutarConsulta($sql2);

            $oUsuario->setFechaHoraUltimaConexion($fechaHoraActual);

            return $oUsuario;
        }

        return null;
    }
}
