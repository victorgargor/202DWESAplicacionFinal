<?php
/**
 * Archivo de configuración y enrutamiento de la aplicación.
 * 
 * @author Víctor García Gordón
 * @version 19/12/2024
 */

// Importamos la librería de validación de formularios
require_once 'core/lValidacionFormularios.php';

// Importamos los modelos de la aplicación
require_once 'model/DB.php';
require_once 'model/DBPDO.php';
require_once 'model/ErrorApp.php';
require_once 'model/Usuario.php';
require_once 'model/UsuarioDB.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/REST.php';
require_once 'model/FotoNasa.php';
require_once 'model/Departamento.php';
require_once 'model/DepartamentoPDO.php';
require_once 'model/ChuckNorrisAPI.php';

/**
 * Array de controladores de la aplicación.
 * 
 * Este array asocia las claves de los módulos con los archivos correspondientes
 * dentro de la carpeta `controller/`.
 * 
 * @var array<string, string> $aControladores
 */
$aControladores = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'detalle' => 'controller/cDetalle.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'api' => 'controller/cREST.php',
    'tecnologias' => 'controller/cTecnologias.php',
    'rss' => 'controller/cRSS.php',
    'registro' => 'controller/cRegistro.php',
    'miCuenta' => 'controller/cMiCuenta.php',
    'borrarCuenta' => 'controller/cborrarCuenta.php',
    'wip' => 'controller/cWIP.php',
    'error' => 'controller/cErrorApp.php',
    'mtodep' => 'controller/cMtoDepartamentos.php',
    'editar' => 'controller/cConsultarModificarDepartamento.php',
    'eliminar' => 'controller/cEliminarDepartamento.php',
    'alta' => 'controller/cAltaDepartamento.php'
];

/**
 * Array de vistas de la aplicación.
 * 
 * Contiene las rutas de los archivos de vista dentro de la carpeta `view/`.
 * 
 * @var array<string, string> $aVistas
 */
$aVistas = [
    'layout' => 'view/Layout.php',
    'inicioPublico' => 'view/vInicioPublico.php',
    'login' => 'view/vLogin.php',
    'detalle' => 'view/vDetalle.php',
    'inicioPrivado' => 'view/vInicioPrivado.php',
    'api' => 'view/vREST.php',
    'tecnologias' => 'view/vTecnologias.php',
    'rss' => 'view/vRSS.php',
    'registro' => 'view/vRegistro.php',
    'miCuenta' => 'view/vMiCuenta.php',
    'borrarCuenta' => 'view/vborrarCuenta.php',
    'wip' => 'view/vWIP.php',
    'error' => 'view/vErrorApp.php',
    'mtodep' => 'view/vMtoDepartamentos.php',
    'editar' => 'view/vConsultarModificarDepartamento.php',
    'eliminar' => 'view/vEliminarDepartamento.php',
    'alta' => 'view/vAltaDepartamento.php'
];
