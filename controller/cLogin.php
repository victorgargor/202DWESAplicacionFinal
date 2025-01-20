<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 13/01/2025
 */

if (isset($_REQUEST['volver'])) {
    // Establece la variable de sesión 'paginaEnCurso' en 'inicioPublico'
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Variable para indicar que las respuestas son correctas
$entradaOK = true;

$aErrores = [
    'usuario' => '',
    'password' => ''
];

if (isset($_REQUEST['iniciarsesion'])) { 
    // Guardamos en la sesión la página anterior y le ponemos el login
    $_SESSION['paginaAnterior'] = 'login';

    // Validamos si el usuario existe y es oUsuarioActivo
    $oUsuarioActivo = UsuarioPDO::validarUsuario($_REQUEST['usuario'], $_REQUEST['password']);

    // Comprobamos si '$oUsuarioActivo' no está declarado o es 'null'
    if (!isset($oUsuarioActivo)) {
        $entradaOK = false;
    }

    // Realizamos las validaciones de los campos de formulario
    $aErrores = [
        'usuario' => (!$oUsuarioActivo) ? 'Error de autentificación.' : validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 32, 4, 1),
        'password' => (!$oUsuarioActivo) ? 'Error de autentificación.' : validacionFormularios::validarPassword($_REQUEST['password'], 32, 4, 2, 1)
    ];

    // Recorremos los errores y comprobamos si hay algún error
    foreach ($aErrores as $campo => $valor) {
        if ($valor != null) {
            // Ponemos la entradaOK a false si hay errores
            $entradaOK = false;
            // Limpiamos los campos de formulario
            $_REQUEST[$campo] = '';
        }
    }
} else {
    // Ponemos la entradaOK a false si no se ha enviado el formulario
    $entradaOK = false;
}

if ($entradaOK) {
    // Si la entrada es correcta, actualizamos la fecha y hora de la última conexión
    $oUsuarioActivo = UsuarioPDO::registrarUltimaConexion($oUsuarioActivo->getCodUsuario());

    // Guardamos el usuario en la sesión
    $_SESSION['usuarioMiAplicacion'] = $oUsuarioActivo;
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';

    // Importamos el controlador de la página activa
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
} else {
    // Si la entrada no es correcta, recargamos la vista del login con los errores
    require_once $aVistas['layout'];
}

