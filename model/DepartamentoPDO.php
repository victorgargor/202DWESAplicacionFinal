<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */

/**
 * Clase DepartamentoPDO
 * 
 * Contiene métodos estáticos para interactuar con la base de datos relacionados con la entidad "Departamento".
 * Estos métodos permiten realizar operaciones como la búsqueda, alta, baja y modificación de departamentos.
 */
class DepartamentoPDO {

    /**
     * Busca un departamento por su código.
     * 
     * Este método aún no está implementado. Debería buscar un departamento basado en su código único.
     * 
     * @return Departamento|null El departamento encontrado o null si no se encuentra.
     */
    public static function buscaDepartamentoPorCod() {
        // Método no implementado.
    }

    /**
     * Busca departamentos por su descripción.
     * 
     * Este método realiza una búsqueda en la base de datos de departamentos cuyo nombre o descripción
     * coincidan parcialmente con el texto proporcionado.
     *
     * @param string $descripcion La descripción o parte de la descripción de los departamentos a buscar.
     * 
     * @return array Un array de objetos Departamento que coinciden con la descripción proporcionada.
     */
    public static function buscaDepartamentosPorDesc($descripcion) {
        $departamentos = [];
        
        // Consulta SQL dependiendo de si se proporciona una descripción
        if (empty($descripcion)) {
            $sentenciaSQL = "SELECT * FROM T02_Departamento";
            $parametros = null;
        } else {
            $sentenciaSQL = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE :descripcion";
            $parametros = [':descripcion' => '%' . $descripcion . '%'];
        }
        
        // Ejecuta la consulta a la base de datos
        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL, $parametros);
        
        // Recupera todos los departamentos encontrados
        while ($oDepartamento = $consultaPreparada->fetchObject()) {
            $departamentos[] = $oDepartamento;
        }
        
        return $departamentos;
    }

    /**
     * Da de alta un nuevo departamento.
     * 
     * Este método aún no está implementado. Debería insertar un nuevo departamento en la base de datos.
     * 
     * @return bool Devuelve true si el departamento fue dado de alta correctamente, false en caso contrario.
     */
    public static function altaDepartamento() {
        // Método no implementado.
    }

    /**
     * Da de baja físicamente un departamento.
     * 
     * Este método aún no está implementado. Debería eliminar un departamento de la base de datos de manera física.
     * 
     * @return bool Devuelve true si el departamento fue eliminado correctamente, false en caso contrario.
     */
    public static function bajaFisicaDepartamento() {
        // Método no implementado.
    }

    /**
     * Da de baja lógicamente un departamento.
     * 
     * Este método aún no está implementado. Debería marcar un departamento como dado de baja sin eliminarlo físicamente.
     * 
     * @return bool Devuelve true si el departamento fue dado de baja correctamente, false en caso contrario.
     */
    public static function bajaLogicaDepartamento() {
        // Método no implementado.
    }

    /**
     * Modifica los datos de un departamento.
     * 
     * Este método aún no está implementado. Debería actualizar los datos de un departamento en la base de datos.
     * 
     * @return bool Devuelve true si el departamento fue modificado correctamente, false en caso contrario.
     */
    public static function modificaDepartamento() {
        // Método no implementado.
    }

    /**
     * Rehabilita un departamento dado de baja lógicamente.
     * 
     * Este método aún no está implementado. Debería cambiar el estado de un departamento dado de baja lógicamente a activo.
     * 
     * @return bool Devuelve true si el departamento fue rehabilitado correctamente, false en caso contrario.
     */
    public static function rehabilitaDepartamento() {
        // Método no implementado.
    }

    /**
     * Valida si el código de un departamento no existe en la base de datos.
     * 
     * Este método aún no está implementado. Debería verificar si el código de un departamento ya está registrado en la base de datos.
     * 
     * @return bool Devuelve true si el código no existe, false si ya existe en la base de datos.
     */
    public static function validaCodNoExiste() {
        // Método no implementado.
    }
}
