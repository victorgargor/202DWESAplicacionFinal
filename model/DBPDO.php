<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */

class DBPDO implements DB {
    
    #[\Override]
    public static function ejecutarConsulta($sentenciaSQL, $parametros = null) {
        try {
            // Establecemos la conexión con la BD
            $miDB = new PDO(DSN, USER, PASSWORD);
            // Prepara la consulta
            $consultaPreparada = $miDB->prepare($sentenciaSQL);          
            // Ejecuta la consulta       
            $consultaPreparada->execute();          
            // Devuelvo el resultado
            return $consultaPreparada;
        } catch (PDOException $excepcion) {
            $_SESSION['paginaAnterior']=$_SESSION['paginaEnCurso'];
            // Guardamos en la sesion la pagina actual y le asignamos la de error
            $_SESSION['paginaEnCurso'] = 'error';
            // Almaceno un objeto de la clase Error
            $_SESSION['error'] = new ErrorApp($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine());          
            //Redirige al usuario al index
            header('Location: indexLoginLogoff.php');
            exit();           
        } finally {
            // Cierra la conexión con la BD
            unset($miDB);
        }
    }
}