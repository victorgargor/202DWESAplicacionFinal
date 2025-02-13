<?php

/**
 * Controlador de mantenimiento de departamentos.
 * 
 * Este script permite buscar departamentos por su descripción y muestra los resultados 
 * en la vista correspondiente.
 * 
 * @author Víctor García Gordón
 * @version 30/01/2025
 */

/**
 * Si el usuario pulsa "Volver", se redirige a la página de inicio privado.
 */
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * @var string $descripcion Almacena la descripción introducida por el usuario para la búsqueda.
 * @var array $departamentos Contiene la lista de departamentos encontrados.
 */
if (isset($_REQUEST['buscar'])) {
    // Obtener la descripción ingresada por el usuario
    $descripcion = $_REQUEST['descripcion'];

    // Buscar departamentos con la descripción proporcionada
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDesc($descripcion);
} else {
    // Si no se ha realizado una búsqueda, mostrar todos los departamentos
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDesc('');
}

// Si el usuario selecciona un departamento para modificar
if (isset($_REQUEST['consultarModificar'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['codDepartamento']; // Guardar en sesión
    $_SESSION['paginaEnCurso'] = 'editar';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si el usuario selecciona un departamento para ver
if (isset($_REQUEST['ver'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['codDepartamento']; // Guardar el código en sesión
    $_SESSION['paginaEnCurso'] = 'editar'; // Mantener la misma página de "editar"
    $modoVer = true; // Activar el modo "ver"
    require_once $aControladores[$_SESSION['paginaEnCurso']]; // Cargar la vista correspondiente
    exit();
}

// Si el usuario selecciona un departamento para eliminar
if (isset($_REQUEST['eliminar'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['codDepartamento']; // Guardar en sesión
    $_SESSION['paginaEnCurso'] = 'eliminar';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si el usuario selecciona dar de alta un departamento
if (isset($_REQUEST['añadir'])) {
    $_SESSION['paginaEnCurso'] = 'alta';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si se pulsa el botón de baja lógica
if (isset($_REQUEST['bajaLogica'])) {
    // Obtener el código del departamento
    $codDepartamento = $_POST['codDepartamento'];

    // Realizar la baja lógica (esto podría ser un método que actualiza la fecha de baja)
    DepartamentoPDO::bajaLogicaDepartamento($codDepartamento);

    // Después de procesar la solicitud, recargamos la misma página con los cambios
    header('Location: ' . $_SERVER['PHP_SELF']); // Recarga la misma página
    exit();
}

// Si se pulsa el botón de rehabilitación
if (isset($_REQUEST['rehabilitar'])) {
    // Obtener el código del departamento
    $codDepartamento = $_POST['codDepartamento'];

    // Realizar la rehabilitación (esto podría ser un método que elimina la fecha de baja)
    DepartamentoPDO::rehabilitaDepartamento($codDepartamento);

    // Después de procesar la solicitud, recargamos la misma página con los cambios
    header('Location: ' . $_SERVER['PHP_SELF']); // Recarga la misma página
    exit();
}

$porPagina = 5; // Número de departamentos por página
$totalDepartamentos = count($departamentos); // Total de departamentos
$totalPaginas = ceil($totalDepartamentos / $porPagina); // Número total de páginas

// Obtén la página actual, si no se especifica, comienza en la 1
$paginaActual = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 1;

// Calcular el índice de inicio
$inicio = ($paginaActual - 1) * $porPagina;

// Obtén solo los departamentos correspondientes a la página actual
$departamentosPagina = array_slice($departamentos, $inicio, $porPagina);

/**
 * Se carga la vista de mantenimiento de departamentos.
 */
require_once $aVistas['layout'];
