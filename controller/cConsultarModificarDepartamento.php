<?php
/**
 * Controlador para consultar y modificar un departamento.
 * 
 * Permite visualizar los detalles de un departamento seleccionado y modificar 
 * los campos de descripción y volumen de negocio.
 * 
 * @author Víctor García Gordón
 * @version 10/02/2025
 */

// Si no hay un código de departamento en sesión, volver al mantenimiento
if (!isset($_SESSION['codDepartamentoEnCurso'])) {
    header('Location: cMtoDepartamentos.php');
    exit();
}

// Obtener el código del departamento guardado en sesión
$codDepartamento = $_SESSION['codDepartamentoEnCurso'];

// Obtener los datos del departamento
$departamento = DepartamentoPDO::buscaDepartamentoPorCod($codDepartamento);

// Si el departamento no existe, volver a la página de mantenimiento
if (!$departamento) {
    header('Location: cMtoDepartamentos.php');
    exit();
}

// Si el usuario pulsa "Guardar", actualizar los datos en la base de datos
if (isset($_POST['guardar'])) {
    $descDepartamento = $_POST['descripcion'];
    $volumenDeNegocio = $_POST['volumenDeNegocio'];

    if (DepartamentoPDO::modificaDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio)) {
        $mensaje = "Departamento actualizado correctamente.";
        $departamento = DepartamentoPDO::buscaDepartamentoPorCod($codDepartamento); // Recargar datos
    } else {
        $mensaje = "Error al actualizar el departamento.";
    }
}

// Si el usuario pulsa "Volver", redirigir a la página de mantenimiento
if (isset($_POST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'mtodep';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Cargar la vista correspondiente (usando el array de vistas)
require_once $aVistas['layout'];
