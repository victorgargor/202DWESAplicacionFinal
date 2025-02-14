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
     * Busca departamentos filtrados por descripción y estado con paginación.
     *
     * Este método permite buscar departamentos cuya descripción coincida parcialmente con el término proporcionado
     * y filtrar los resultados según su estado (activos, de baja o todos). También aplica paginación para limitar 
     * la cantidad de resultados devueltos en cada consulta.
     *
     * @param string $descripcion Texto de la descripción a buscar. Se usa "LIKE" para coincidencias parciales.
     * @param string $estado Estado de los departamentos a filtrar. Puede ser:
     *                       - 'activos': Solo departamentos sin fecha de baja.
     *                       - 'baja': Solo departamentos con fecha de baja.
     *                       - 'todos': No aplica filtro de estado.
     * @param int $pagina Número de la página actual para la paginación.
     * @param int $resultadosPorPagina Cantidad de registros que se deben mostrar por página.
     * 
     * @return array Un array de objetos con los departamentos que cumplen con los filtros y la paginación.
     */
    public static function buscaDepartamentosPorDescYEstado($descripcion, $estado, $pagina, $resultadosPorPagina) {
        $departamentos = [];
        $inicio = ($pagina - 1) * $resultadosPorPagina; // Calcular el primer registro de la página actual
        // Construcción de la consulta base con filtrado por descripción
        $sentenciaSQL = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE :descripcion";
        $parametros = [':descripcion' => '%' . $descripcion . '%'];

        // Aplicar filtro por estado
        if ($estado == 'activos') {
            $sentenciaSQL .= " AND T02_FechaBajaDepartamento IS NULL";
        } elseif ($estado == 'baja') {
            $sentenciaSQL .= " AND T02_FechaBajaDepartamento IS NOT NULL";
        }

        // Agregar límite de paginación usando concatenación para evitar errores de parámetro
        $sentenciaSQL .= " LIMIT " . (int) $inicio . ", " . (int) $resultadosPorPagina;

        // Ejecutar consulta
        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL, $parametros);

        // Obtener los resultados en un array de objetos
        while ($oDepartamento = $consultaPreparada->fetchObject()) {
            $departamentos[] = $oDepartamento;
        }

        return $departamentos;
    }

    /**
     * Cuenta la cantidad total de departamentos que cumplen con los filtros de descripción y estado.
     *
     * Este método permite conocer cuántos departamentos existen en la base de datos según los filtros aplicados.
     * Es útil para calcular la cantidad de páginas necesarias en la paginación.
     *
     * @param string $descripcion Texto de la descripción a buscar. Se usa "LIKE" para coincidencias parciales.
     * @param string $estado Estado de los departamentos a filtrar. Puede ser:
     *                       - 'activos': Solo departamentos sin fecha de baja.
     *                       - 'baja': Solo departamentos con fecha de baja.
     *                       - 'todos': No aplica filtro de estado.
     * 
     * @return int El número total de departamentos que cumplen con los criterios de búsqueda.
     */
    public static function contarDepartamentosPorDescYEstado($descripcion, $estado) {
        // Construcción de la consulta base con filtro por descripción
        $sentenciaSQL = "SELECT COUNT(*) as total FROM T02_Departamento WHERE T02_DescDepartamento LIKE :descripcion";
        $parametros = [':descripcion' => '%' . $descripcion . '%'];

        // Aplicar filtro por estado
        if ($estado == 'activos') {
            $sentenciaSQL .= " AND T02_FechaBajaDepartamento IS NULL";
        } elseif ($estado == 'baja') {
            $sentenciaSQL .= " AND T02_FechaBajaDepartamento IS NOT NULL";
        }

        // Ejecutar consulta
        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL, $parametros);
        $resultado = $consultaPreparada->fetch(PDO::FETCH_ASSOC);

        // Retornar el total de departamentos encontrados
        return $resultado['total'] ?? 0;
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
     * Método que exporta todos los departamentos en formato XML y lo fuerza a descargar.
     *
     * @return void
     */
    public static function exportaDepartamentos() {
        // Consulta SQL para obtener todos los departamentos
        $sentenciaSQL = "SELECT * FROM T02_Departamento";
        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL);

        // Crear un nuevo documento XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><departamentos></departamentos>');

        // Recorrer los resultados y agregarlos al XML
        while ($departamento = $consultaPreparada->fetch(PDO::FETCH_ASSOC)) {
            $deptXML = $xml->addChild('departamento');
            foreach ($departamento as $clave => $valor) {
                $deptXML->addChild($clave, htmlspecialchars($valor));
            }
        }

        // Definir el nombre del archivo
        $nombreArchivo = "departamentos.xml";

        // Configurar las cabeceras para forzar la descarga
        header('Content-Type: application/xml; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');

        // Imprimir el XML y terminar la ejecución
        echo $xml->asXML();
        exit;
    }

    /**
     * Importa departamentos desde un archivo XML.
     * 
     * Este método lee un archivo XML, extrae la información de los departamentos y los inserta
     * en la base de datos. Si un departamento ya existe, se actualiza su información.
     * 
     * @param string $archivoXML Ruta del archivo XML a importar.
     * @return string Mensaje con el resultado de la importación.
     */
    public static function importaDepartamentos($archivoXML) {
        if (!file_exists($archivoXML)) {
            return "Error: No se encontró el archivo XML.";
        }

        // Cargar el XML
        $xml = simplexml_load_file($archivoXML);
        if (!$xml) {
            return "Error: No se pudo cargar el archivo XML.";
        }

        foreach ($xml->departamento as $departamento) {
            $codigo = (string) $departamento->T02_CodDepartamento;  // Actualizar con el nombre correcto
            $descripcion = (string) $departamento->T02_DescDepartamento;  // Actualizar con el nombre correcto
            $fechaAlta = (string) $departamento->T02_FechaCreacionDepartamento;  // Actualizar con el nombre correcto
            $volumenNegocio = (float) $departamento->T02_VolumenDeNegocio;  // Actualizar con el nombre correcto
            $fechaBaja = (string) $departamento->T02_FechaBajaDepartamento;  // Actualizar con el nombre correcto
            // Si FechaBajaDepartamento está vacío, usar 'null'
            $fechaBaja = empty($fechaBaja) ? null : $fechaBaja;

            // Verificar si el departamento ya existe
            $sqlExistencia = "SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = ?";
            $resultado = DBPDO::ejecutarConsulta($sqlExistencia, [$codigo]);

            if ($resultado->rowCount() > 0) {
                // Actualizar si ya existe
                $sqlActualizar = "UPDATE T02_Departamento SET 
                    T02_DescDepartamento = ?, 
                    T02_FechaCreacionDepartamento = ?, 
                    T02_VolumenDeNegocio = ?, 
                    T02_FechaBajaDepartamento = ? 
                    WHERE T02_CodDepartamento = ?";
                DBPDO::ejecutarConsulta($sqlActualizar, [$descripcion, $fechaAlta, $volumenNegocio, $fechaBaja, $codigo]);
                $contadorActualizados++;
            } else {
                // Insertar si no existe
                $sqlInsertar = "INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento) 
                    VALUES (?, ?, ?, ?, ?)";
                DBPDO::ejecutarConsulta($sqlInsertar, [$codigo, $descripcion, $fechaAlta, $volumenNegocio, $fechaBaja]);
                $contadorInsertados++;
            }
        }

        return "Importación completada: $contadorInsertados nuevos departamentos insertados, $contadorActualizados actualizados.";
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
