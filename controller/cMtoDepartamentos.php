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

/**
 * Se carga la vista de mantenimiento de departamentos.
 */
require_once $aVistas['layout'];
