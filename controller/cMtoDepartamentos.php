<?php
/**
 * Controlador de mantenimiento de departamentos.
 * 
 * Este script permite buscar departamentos por su descripción y muestra los resultados 
 * en la vista correspondiente.
 * 
 * @author Víctor García Gordón
 * @version 13/02/2025
 */

/**
 * Si el usuario pulsa "Volver", se redirige a la página de inicio privado.
 */
if (isset($_REQUEST['volver'])) {
    // Borrar las variables de sesión de búsqueda
    unset($_SESSION['descripcionBuscada']);
    unset($_SESSION['estadoFiltro']);
    unset($_SESSION['pagina']); // Opcional, si deseas reiniciar la paginación

    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Definir cantidad de resultados por página
$resultadosPorPagina = 5;

// Si no existe una sesión para la página, inicializar en 1
if (!isset($_SESSION['pagina'])) {
    $_SESSION['pagina'] = 1;
}

// --------------------
// Procesar la paginación
// --------------------
if (isset($_REQUEST['paginaPrimera'])) {
    $_SESSION['pagina'] = 1;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_REQUEST['paginaAnterior'])) {
    if ($_SESSION['pagina'] > 1) {
        $_SESSION['pagina']--;
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_REQUEST['paginaSiguiente'])) {
    $_SESSION['pagina']++;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_REQUEST['paginaUltima'])) {
    // Obtener los filtros actuales para calcular el total de páginas
    $descripcion = isset($_SESSION['descripcionBuscada']) ? $_SESSION['descripcionBuscada'] : '';
    $estado = isset($_SESSION['estadoFiltro']) ? $_SESSION['estadoFiltro'] : 'todos';
    $totalDepartamentos = DepartamentoPDO::contarDepartamentosPorDescYEstado($descripcion, $estado);
    $totalPaginas = max(1, ceil($totalDepartamentos / $resultadosPorPagina));
    $_SESSION['pagina'] = $totalPaginas;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Inicializar variable $totalPaginas
$totalPaginas = 1; // Valor predeterminado en caso de no haber búsqueda

// Si el usuario pulsa "Buscar"
if (isset($_REQUEST['buscar'])) {
    // Obtener la descripción ingresada por el usuario
    $descripcion = $_REQUEST['descripcion'];
    $_SESSION['descripcionBuscada'] = $descripcion; // Guardar en sesión para mantener la búsqueda

    // Obtener el estado seleccionado (activos, baja o todos)
    $estado = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : 'todos'; // 'todos' por defecto
    $_SESSION['estadoFiltro'] = $estado; // Guardar el filtro en sesión

    // Contar total de departamentos para calcular páginas
    $totalDepartamentos = DepartamentoPDO::contarDepartamentosPorDescYEstado($descripcion, $estado);
    $totalPaginas = max(1, ceil($totalDepartamentos / $resultadosPorPagina));

    // Verifica que la página actual no exceda el total de páginas
    if ($_SESSION['pagina'] > $totalPaginas) {
        $_SESSION['pagina'] = $totalPaginas;
    }

    // Obtener departamentos con paginación
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDescYEstado($descripcion, $estado, $_SESSION['pagina'], $resultadosPorPagina);
} else {
    // Si no se ha realizado una búsqueda, mantener los filtros existentes en sesión si existen
    $descripcion = isset($_SESSION['descripcionBuscada']) ? $_SESSION['descripcionBuscada'] : '';
    $estado = isset($_SESSION['estadoFiltro']) ? $_SESSION['estadoFiltro'] : 'todos';

    // Obtener departamentos con paginación utilizando los valores de sesión
    $departamentos = DepartamentoPDO::buscaDepartamentosPorDescYEstado($descripcion, $estado, $_SESSION['pagina'], $resultadosPorPagina);

    // Si no están definidos en la sesión, se definen valores por defecto
    if (!isset($_SESSION['estadoFiltro'])) {
        $_SESSION['estadoFiltro'] = 'todos'; // Valor predeterminado
    }
    if (!isset($_SESSION['descripcionBuscada'])) {
        $_SESSION['descripcionBuscada'] = '';
    }

    // Contar total de departamentos para calcular páginas
    $totalDepartamentos = DepartamentoPDO::contarDepartamentosPorDescYEstado($descripcion, $estado);
    $totalPaginas = max(1, ceil($totalDepartamentos / $resultadosPorPagina)); // Evitar división por 0
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
    $codDepartamento = $_REQUEST['codDepartamento'];

    // Realizar la baja lógica (esto podría ser un método que actualiza la fecha de baja)
    DepartamentoPDO::bajaLogicaDepartamento($codDepartamento);

    // Después de procesar la solicitud, recargamos la misma página con los cambios
    header('Location: ' . $_SERVER['PHP_SELF']); // Recarga la misma página
    exit();
}

// Si se pulsa el botón de rehabilitación
if (isset($_REQUEST['rehabilitar'])) {
    // Obtener el código del departamento
    $codDepartamento = $_REQUEST['codDepartamento'];

    // Realizar la rehabilitación (esto podría ser un método que elimina la fecha de baja)
    DepartamentoPDO::rehabilitaDepartamento($codDepartamento);

    // Después de procesar la solicitud, recargamos la misma página con los cambios
    header('Location: ' . $_SERVER['PHP_SELF']); // Recarga la misma página
    exit();
}

// Si se pulsa exportar
if (isset($_REQUEST['exportar'])) {
    DepartamentoPDO::exportaDepartamentos();
}

// Si se pulsa importar
if (isset($_REQUEST['importar'])) {
    if (isset($_FILES['archivoXML']) && $_FILES['archivoXML']['error'] == UPLOAD_ERR_OK) {
        $archivoXML = $_FILES['archivoXML']['tmp_name'];
        $mensaje = DepartamentoPDO::importaDepartamentos($archivoXML);
        $_SESSION['mensajeImportacion'] = $mensaje;
    } else {
        $_SESSION['mensajeImportacion'] = 'Error al subir el archivo.';
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Cargar la vista de mantenimiento de departamentos
require_once $aVistas['layout'];
