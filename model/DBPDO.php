<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 09/01/2025
 */

/**
 * Clase DBPDO
 * 
 * Implementa la interfaz DB utilizando PDO para ejecutar consultas SQL en la base de datos.
 * Esta clase maneja la conexión a la base de datos y la ejecución de consultas.
 */
class DBPDO implements DB {

    /**
     * Ejecuta una consulta SQL preparada en la base de datos.
     * 
     * Establece una conexión con la base de datos, prepara la consulta SQL, la ejecuta
     * y devuelve el resultado. Si ocurre un error, captura la excepción, guarda información
     * de error en la sesión y redirige al usuario a la página de error.
     *
     * @param string $sentenciaSQL La sentencia SQL a ejecutar.
     * @param array|null $parametros Los parámetros para la consulta SQL (por defecto, es null).
     * 
     * @return PDOStatement El objeto de la consulta preparada tras su ejecución.
     */
    #[\Override]
    public static function ejecutarConsulta($sentenciaSQL, $parametros = null) {
        try {
            // Establece la conexión con la base de datos utilizando PDO
            $miDB = new PDO(DSN, USER, PASSWORD);

            // Prepara la consulta SQL para su ejecución
            $consultaPreparada = $miDB->prepare($sentenciaSQL);

            // Ejecuta la consulta con los parámetros proporcionados
            $consultaPreparada->execute($parametros);

            // Devuelve el objeto de la consulta preparada con los resultados
            return $consultaPreparada;
        } catch (PDOException $excepcion) {
            /**
             * Si ocurre una excepción durante la ejecución de la consulta,
             * se captura el error y se maneja apropiadamente.
             * La información del error se guarda en la sesión, y el usuario es redirigido
             * a una página de error.
             */
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
            // Guardamos la página actual en la sesión y asignamos la página de error
            $_SESSION['paginaEnCurso'] = 'error';

            // Almacena un objeto de la clase ErrorApp con los detalles del error
            $_SESSION['error'] = new ErrorApp(
                $excepcion->getCode(), 
                $excepcion->getMessage(), 
                $excepcion->getFile(), 
                $excepcion->getLine(), 
                $_SESSION['paginaAnterior']
            );

            // Redirige al usuario al index de login/logoff
            header('Location: indexLoginLogoff.php');
            exit();
        } finally {
            // Asegura que la conexión a la base de datos se cierra después de la ejecución
            unset($miDB);
        }
    }
}
