<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */

class UsuarioPDO implements UsuarioDB{
    
    #[\Override]
    public static function validarUsuario($codUsuario, $password) {    
        // Inicializamos un objeto Usuario
        $oUsuario = null; 
        
        $sql = <<<SQL
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}' 
            AND T01_Password = SHA2('{$codUsuario}{$password}', 256);
        SQL;

        // Ejecutar la consulta
        $resultadoConsulta = DBPDO::ejecutarConsulta($sql);

        // Verificar si se encuentra el usuario
        if ($resultadoConsulta->rowCount() > 0) {                   
            $oResultadoConsulta = $resultadoConsulta->fetchObject();
          
            if ($oResultadoConsulta) {            
                // Instancio un nuevo usuario
                $oUsuario = new Usuario(
                        $oResultadoConsulta->T01_CodUsuario,
                        $oResultadoConsulta->T01_Password,
                        $oResultadoConsulta->T01_DescUsuario,
                        $oResultadoConsulta->T01_NumConexiones,
                        $oResultadoConsulta->T01_FechaHoraUltimaConexion,
                        $oResultadoConsulta->T01_FechaHoraUltimaConexionAnterior=null,
                        $oResultadoConsulta->T01_Perfil
                );
            }
        }
        // Devuelve el objeto Usuario
        return $oUsuario;
    }
    
    public static function altaUsuario(){
        
    }
    
    public static function modificarUsuario(){
        
    }
    
    public static function borrarUsuario(){
        
    }
    
    public static function validarCodNoExiste(){
        
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

