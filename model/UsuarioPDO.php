<?php

/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */
class UsuarioPDO implements UsuarioDB {
    
    /**
    * @author Jesús Ferreras González, Víctor García Gordón
    * 
    */
    #[\Override]
    public static function validarUsuario($codUsuario, $password) {
        $parametros = [
            ':codUsuario' => $codUsuario,
            ':password' => $codUsuario . $password
        ];
        // Consulta SQL para obtener el usuario por código y contraseña
        $sql = <<<SQL
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = :codUsuario 
            AND T01_Password = sha2(:password, 256);
        SQL;

        // Ejecutamos la consulta
        $resultadoConsulta = DBPDO::ejecutarConsulta($sql, $parametros);

        // Verificamos si el usuario existe
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
    * @author Jesús Ferreras González, Víctor García Gordón
    * 
    */
    public static function altaUsuario($codUsuario, $password, $descUsuario, $imagenUsuario = null) {
        $parametros = [
            ':codUsuario' => $codUsuario,
            ':password' => $codUsuario . $password,
            ':descUsuario' => $descUsuario,
            ':imagenUsuario' => $imagenUsuario
        ];
        // Sentencia SQL para insertar el nuevo usuario en la base de datos
        $sql = <<<SQL
            INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_ImagenUsuario)
            VALUES (:codUsuario, sha2(:password, 256), :descUsuario, :imagenUsuario);
        SQL;

        // Ejecutamos la consulta
        $resultado = DBPDO::ejecutarConsulta($sql, $parametros);

        $sql2 = <<<FIN
            SELECT * FROM T01_Usuario
                WHERE T01_CodUsuario = '$codUsuario'
            ;
        FIN;

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

    public static function modificarUsuario() {
        
    }

    public static function borrarUsuario() {
        
    }

    public static function validarCodNoExiste($codUsuario) {
        // Define la consulta SQL para validar el código
        $sql = <<<SQL
            SELECT COUNT(*) FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}';
        SQL;

        // Ejecutar la consulta
        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);

        // Obtenemos el resultado (la cantidad de registros que coinciden)
        $registro = $resultadoConsulta->fetch(PDO::FETCH_ASSOC);

        // Si el contador es mayor que 0, significa que el código ya existe
        return $registro['COUNT(*)'] > 0;
    }

    public static function registrarUltimaConexion($codUsuario) {
        // Obtener la fecha y hora actual
        $fechaHoraActual = date('Y-m-d H:i:s');

        $sql = <<<SQL
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}';
        SQL;

        // Ejecutar la consulta
        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);

        // Verificar si se encuentra el usuario
        if ($resultadoConsulta->rowCount() > 0) {
            $oResultadoConsulta = $resultadoConsulta->fetchObject();

            // Crear objeto Usuario
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

            // Actualizar el número de accesos y la fecha de la última conexión anterior
            $oUsuario->setNumAccesos($oUsuario->getNumAccesos() + 1);
            $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());

            $sql2 = <<<SQL2
                UPDATE T01_Usuario
                SET T01_NumConexiones = T01_NumConexiones + 1,
                    T01_FechaHoraUltimaConexion = '{$fechaHoraActual}'
                WHERE T01_CodUsuario = '{$codUsuario}';
            SQL2;

            // Ejecutar la consulta 
            DBPDO::ejecutarConsulta($sql2);

            // Actualizar el objeto Usuario con la nueva fecha de conexión
            $oUsuario->setFechaHoraUltimaConexion($fechaHoraActual);

            // Retornar el objeto Usuario actualizado
            return $oUsuario;
        }

        // Si no se encuentra el usuario, devolver null
        return null;
    }
}
