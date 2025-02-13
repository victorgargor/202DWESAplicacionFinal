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
     * @param string $codDepartamento Código del departamento a buscar.
     * @return object|null Datos del departamento encontrado o null si no existe.
     */
    public static function buscaDepartamentoPorCod($codDepartamento) {
        $sentenciaSQL = "SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = :codDepartamento";
        $parametros = [':codDepartamento' => $codDepartamento];

        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL, $parametros);

        return $consultaPreparada->fetchObject() ?: null;
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
     * Da de alta un nuevo departamento en la base de datos.
     * 
     * Inserta un nuevo registro en la tabla `T02_Departamento` con el código, 
     * descripción y volumen de negocio proporcionados. La fecha de creación 
     * se registra automáticamente con la fecha y hora actual.
     * 
     * @param string $codDepartamento Código único del departamento (3 letras mayúsculas).
     * @param string $descDepartamento Descripción del departamento (máximo 255 caracteres).
     * @param float $volumenDeNegocio Volumen de negocio del departamento (valor positivo).
     * 
     * @return bool Devuelve `true` si el departamento fue insertado correctamente, `false` en caso contrario.
     */
    public static function altaDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio) {
        $sentenciaSQL = "INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio, T02_FechaCreacionDepartamento) 
                     VALUES (:codDepartamento, :descDepartamento, :volumenDeNegocio, NOW())";

        $parametros = [
            ':codDepartamento' => $codDepartamento,
            ':descDepartamento' => $descDepartamento,
            ':volumenDeNegocio' => $volumenDeNegocio
        ];

        return DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)->rowCount() > 0;
    }

    /**
     * Elimina físicamente un departamento de la base de datos.
     * 
     * @param string $codDepartamento Código del departamento a eliminar.
     * @return bool Devuelve true si la eliminación fue exitosa, false en caso contrario.
     */
    public static function bajaFisicaDepartamento($codDepartamento) {
        $sentenciaSQL = "DELETE FROM T02_Departamento WHERE T02_CodDepartamento = :codDepartamento";
        $parametros = [':codDepartamento' => $codDepartamento];

        return DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)->rowCount() > 0;
    }

    /**
     * Da de baja lógicamente un departamento al establecer la fecha de baja en el campo `T02_FechaBajaDepartamento`.
     * 
     * Este método no elimina el departamento, solo marca su estado como "baja", estableciendo la fecha de baja en la base de datos.
     * 
     * @param string $codDepartamento Código del departamento a dar de baja.
     * @return bool Devuelve `true` si el departamento fue dado de baja correctamente, `false` en caso contrario.
     */
    public static function bajaLogicaDepartamento($codDepartamento) {
        $sentenciaSQL = "UPDATE T02_Departamento SET T02_FechaBajaDepartamento = NOW() WHERE T02_CodDepartamento = :codDepartamento AND T02_FechaBajaDepartamento IS NULL";
        $parametros = [':codDepartamento' => $codDepartamento];

        return DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)->rowCount() > 0;
    }

    /**
     * Modifica la descripción y el volumen de negocio de un departamento.
     * 
     * @param string $codDepartamento Código del departamento a modificar.
     * @param string $descDepartamento Nueva descripción del departamento.
     * @param float $volumenDeNegocio Nuevo volumen de negocio.
     * @return bool True si la actualización fue exitosa, False en caso contrario.
     */
    public static function modificaDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio) {
        $sentenciaSQL = "UPDATE T02_Departamento 
                     SET T02_DescDepartamento = :descDepartamento, 
                         T02_VolumenDeNegocio = :volumenDeNegocio 
                     WHERE T02_CodDepartamento = :codDepartamento";

        $parametros = [
            ':descDepartamento' => $descDepartamento,
            ':volumenDeNegocio' => $volumenDeNegocio,
            ':codDepartamento' => $codDepartamento
        ];

        return DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)->rowCount() > 0;
    }

    /**
     * Rehabilita un departamento marcado como baja lógica al eliminar la fecha de baja (`T02_FechaBajaDepartamento`).
     * 
     * Este método permite recuperar un departamento dado de baja, dejándolo de nuevo en estado activo al eliminar la fecha de baja.
     * 
     * @param string $codDepartamento Código del departamento a rehabilitar.
     * @return bool Devuelve `true` si el departamento fue rehabilitado correctamente, `false` en caso contrario.
     */
    public static function rehabilitaDepartamento($codDepartamento) {
        $sentenciaSQL = "UPDATE T02_Departamento SET T02_FechaBajaDepartamento = NULL WHERE T02_CodDepartamento = :codDepartamento";
        $parametros = [':codDepartamento' => $codDepartamento];

        return DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)->rowCount() > 0;
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
