<?php

/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 30/01/2025
 */
// Redirige a la página del programa si se pulsa el botón
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si se ha presionado el botón "Buscar"
if (isset($_REQUEST['buscar'])) {
    $descripcion = $_REQUEST['descripcion'];

    // Llamamos a la función buscaDepartamentosPorDesc de DepartamentoPDO
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDesc($descripcion);
} else {
    // Si no se ha buscado, mostramos todos los departamentos
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDesc('');
}

// Cargo la vMtoDepartamentos
require_once $aVistas['layout'];
