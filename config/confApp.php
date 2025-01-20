<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */

// Importamos la libreria de validacion de formularios
require_once 'core/lValidacionFormularios.php';

require_once 'model/DB.php';
require_once 'model/DBPDO.php';
require_once 'model/ErrorApp.php';
require_once 'model/Usuario.php';
require_once 'model/UsuarioDB.php';
require_once 'model/UsuarioPDO.php';

// Creamos un array para los controladores
$aControladores = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'detalle' => 'controller/cDetalle.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'tecnologias' => 'controller/cTecnologias.php',
    'rss' => 'controller/cRSS.php',
    'registro' => 'controller/cRegistro.php',
    'miCuenta' => 'controller/cMiCuenta.php',
    'borrarCuenta' => 'controller/cborrarCuenta.php',
    'wip' => 'controller/cWIP.php',
    'error' => 'controller/cErrorApp.php'
];

// Creamos un array para las vistas
$aVistas = [
    'layout' => 'view/Layout.php',
    'inicioPublico' => 'view/vInicioPublico.php',
    'login' => 'view/vLogin.php',
    'detalle' => 'view/vDetalle.php',
    'inicioPrivado' => 'view/vInicioPrivado.php',
    'tecnologias' => 'view/vTecnologias.php',
    'rss' => 'view/vRSS.php',
    'registro' => 'view/vRegistro.php',
    'miCuenta' => 'view/vMiCuenta.php',
    'borrarCuenta' => 'view/vborrarCuenta.php',
    'wip' => 'view/vWIP.php',
    'error' => 'view/vErrorApp.php'
];