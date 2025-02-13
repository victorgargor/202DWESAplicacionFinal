<?php
/**
 * Controlador para consultar y modificar un departamento.
 * 
 * Permite visualizar los detalles de un departamento seleccionado y modificar 
 * los campos de descripción y volumen de negocio.
 * 
 * @author Víctor García Gordón
 * @version 13/02/2025
 */

// Verificar si hay un código de departamento en sesión
if (!isset($_SESSION['codDepartamentoEnCurso'])) {
    header('Location: cMtoDepartamentos.php');
    exit();
}

// Obtener código del departamento
$codDepartamento = $_SESSION['codDepartamentoEnCurso'];

// Obtener los datos del departamento desde la base de datos
$departamento = DepartamentoPDO::buscaDepartamentoPorCod($codDepartamento);

// Si no existe el departamento, redirigir a la página principal
if (!$departamento) {
    header('Location: cMtoDepartamentos.php');
    exit();
}

// Inicialización de variables
$mensaje = "";
$entradaOK = true;

$aErrores = [
    'descripcion' => '',
    'volumenDeNegocio' => ''
];

// Si el usuario pulsa "Volver", regresar a la página de mantenimiento
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'mtodep';
    header('Location: indexLoginLogoff.php');
    exit();
}

// Si el usuario pulsa "Guardar", validar los datos
if (isset($_REQUEST['guardar'])) {
    $aErrores['descripcion'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 1, 1);
    $aErrores['volumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenDeNegocio'], PHP_FLOAT_MAX, 0, 1);

    // Verificar si hay errores en la validación
    foreach ($aErrores as $valor) {
        if (!empty($valor)) {
            $entradaOK = false;
        }
    }

    // Si la validación es correcta, actualizar los datos
    if ($entradaOK) {
        if (DepartamentoPDO::modificaDepartamento($codDepartamento, $_REQUEST['descripcion'], $_REQUEST['volumenDeNegocio'])) {
            $mensaje = "Departamento actualizado correctamente.";
            $departamento = DepartamentoPDO::buscaDepartamentoPorCod($codDepartamento); // Recargar datos
        } else {
            $mensaje = "Error al actualizar el departamento.";
        }
    } else {
        $mensaje = "Introduzca valores validos.";
    }
}

// Cargar la vista correspondiente
require_once $aVistas['layout'];