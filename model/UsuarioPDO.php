<?php

/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */
class UsuarioPDO implements UsuarioDB {

    #[\Override]
    public static function validarUsuario($codUsuario, $password) {
        // Inicializamos un objeto Usuario
        $oUsuario = null;

        // Concatenamos el código del usuario con la contraseña para hacer el hash
        $passwordHashed = hash('sha256', $codUsuario . $password);

        $sql = <<<SQL
        SELECT * FROM T01_Usuario 
        WHERE T01_CodUsuario = '{$codUsuario}' 
        AND T01_Password = '{$passwordHashed}';
        SQL;

        // Ejecutar la consulta
        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);

        // Verificar si se encuentra el usuario
        if ($resultadoConsulta->rowCount() > 0) {
            $oResultadoConsulta = $resultadoConsulta->fetchObject();

            if ($oResultadoConsulta) {
                $oUsuario = new Usuario(
                        $oResultadoConsulta->T01_CodUsuario,
                        $oResultadoConsulta->T01_Password,
                        $oResultadoConsulta->T01_DescUsuario,
                        $oResultadoConsulta->T01_NumConexiones,
                        $oResultadoConsulta->T01_FechaHoraUltimaConexion,
                        $oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior = null,
                        $oResultadoConsulta->T01_Perfil
                );
                return $oUsuario; // Usuario encontrado
            }
        }
        return null; // Si no se encuentra el usuario, retornamos null
    }

    public static function altaUsuario($usuario) {
        // Accede a los métodos del objeto Usuario
        $codUsuario = $usuario->getCodUsuario();
        $password = $usuario->getPassword();
        $descUsuario = $usuario->getDescUsuario();

        // Encriptamos la contraseña antes de insertarla
        $passwordHashed = hash('sha256', $codUsuario . $password);  // Encriptamos la contraseña con SHA-256
        // Sentencia SQL con los valores directamente en la consulta
        $sql = "INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_NumConexiones, T01_FechaHoraUltimaConexion, T01_Perfil)
            VALUES ('{$codUsuario}', '{$passwordHashed}', '{$descUsuario}', 0, NULL, 'usuario');";

        // Ejecutamos la consulta
        $resultado = DBPDO::ejecutarConsulta($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
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
        if ($registro['COUNT(*)'] > 0) {
            return true; // El código ya existe
        } else {
            return false; // El código no existe
        }
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
                    $oResultadoConsulta->T01_Perfil
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
