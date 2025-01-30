<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */
class DepartamentoPDO{
    public static function buscaDepartamentoPorCod(){
        
    }
    
    public static function buscaDepartamentosPorDesc($descripcion) {
        $departamentos = [];
        
        // Consulta SQL
        if (empty($descripcion)) {
            $sentenciaSQL = "SELECT * FROM T02_Departamento";
            $parametros = null;
        } else {
            $sentenciaSQL = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE :descripcion";
            $parametros = [':descripcion' => '%' . $descripcion . '%'];
        }
        
        // Ejecutar la consulta
        $consultaPreparada = DBPDO::ejecutarConsulta($sentenciaSQL, $parametros);
        
        // Recuperar todos los departamentos
        while ($oDepartamento = $consultaPreparada->fetchObject()) {
            $departamentos[] = $oDepartamento;
        }
        
        return $departamentos;
    }
    
    public static function altaDepartamento(){
        
    }
    
    public static function bajaFisicaDepartamento(){
        
    }
    
    public static function bajaLogicaDepartamento(){
        
    }
    
    public static function modificaDepartamento(){
        
    }
    
    public static function rehabilitaDepartamento(){
        
    }
    
    public static function validaCodNoExiste(){
        
    }
}