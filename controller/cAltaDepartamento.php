<?php
/**
 * Controlador para dar de alta un nuevo departamento.
 * 
 * @author Víctor García Gordón
 * @version 14/02/2025
 */

$entradaOK = true;

$aErrores = [
    'codigo' => '',
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
    // Validar código: 3 letras mayúsculas
    if (!preg_match('/^[A-Z]{3}$/', $_REQUEST['codigo'])) {
        $aErrores['codigo'] = "El código debe tener exactamente 3 letras mayúsculas.";
    } elseif (DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codigo'])) {
        $aErrores['codigo'] = "El código ya existe.";
    }

    // Validar descripción
    $aErrores['descripcion'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 1, 1);

    // Validar volumen de negocio
    $aErrores['volumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenDeNegocio'], PHP_FLOAT_MAX, 0, 1);

    // Verificar si hay errores
    foreach ($aErrores as $error) {
        if (!empty($error)) {
            $entradaOK = false;
        }
    }

    // Si la validación es correcta, registrar el departamento
    if ($entradaOK) {
        if (DepartamentoPDO::altaDepartamento($_REQUEST['codigo'], $_REQUEST['descripcion'], $_REQUEST['volumenDeNegocio'])) {
            // Redirigir directamente al mantenimiento de departamentos
            $_SESSION['paginaEnCurso'] = 'mtodep';
            header('Location: indexLoginLogoff.php');
            exit();
        }
    }
}

// Cargar la vista
require_once $aVistas['layout'];
