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
    // Validar descripción
    $aErrores['descripcion'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 1, 1);

    // Validar volumen de negocio
    $aErrores['volumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenDeNegocio'], PHP_FLOAT_MAX, 0, 1);

    // Verificar si hay errores en la validación
    foreach ($aErrores as $valor) {
        if (!empty($valor)) {
            $entradaOK = false;
        }
    }

    // Comprobar si no se ha realizado ningún cambio
    if ($entradaOK && ($_REQUEST['descripcion'] == $departamento->T02_DescDepartamento) && ($_REQUEST['volumenDeNegocio'] == $departamento->T02_VolumenDeNegocio)) {
        // Si no hay cambios, redirigir al mantenimiento de departamentos
        $_SESSION['paginaEnCurso'] = 'mtodep';
        header('Location: indexLoginLogoff.php');
        exit();
    }

    // Si la validación es correcta y hay cambios, actualizar los datos
    if ($entradaOK) {
        if (DepartamentoPDO::modificaDepartamento($codDepartamento, $_REQUEST['descripcion'], $_REQUEST['volumenDeNegocio'])) {
            // Redirigir a la página de mantenimiento de departamentos
            header('Location: cMtoDepartamentos.php');
            exit();
        }
    }
}

// Cargar la vista correspondiente
require_once $aVistas['layout'];

