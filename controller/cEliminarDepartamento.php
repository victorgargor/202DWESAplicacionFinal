<?php
/**
 * Controlador de eliminación de departamentos.
 * 
 * Permite al usuario eliminar un departamento, mostrando sus datos antes de confirmar la eliminación.
 * 
 * @author Víctor García Gordón
 * @version 13/02/2025
 */

if (isset($_REQUEST['cancelar'])) {
    $_SESSION['paginaEnCurso'] = 'mtodep';
    header('Location: indexLoginLogoff.php');
    exit();
}

// Obtener el código del departamento a eliminar
$codigoDepartamento = $_SESSION['codDepartamentoEnCurso'];
$departamento = DepartamentoPDO::buscaDepartamentoPorCod($codigoDepartamento);

if (!$departamento) {
    $mensaje = "Error: Departamento no encontrado.";
} elseif (isset($_REQUEST['confirmarEliminar'])) {
    if (DepartamentoPDO::bajaFisicaDepartamento($codigoDepartamento)) {
        $_SESSION['mensaje'] = "Departamento eliminado correctamente.";
        $_SESSION['paginaEnCurso'] = 'mtodep';
        header('Location: indexLoginLogoff.php');
        exit();
    } else {
        $mensaje = "Error: No se pudo eliminar el departamento.";
    }
}

// Cargar la vista de eliminación
require_once $aVistas['layout'];
