<?php
/**
 * Controlador del proceso de inicio de sesión.
 * 
 * Este script gestiona la autenticación de usuarios, validando credenciales y redirigiendo 
 * a la página correspondiente según la acción realizada.
 * 
 * @author Víctor García Gordón
 * @version 13/01/2025
 */

/**
 * Si el usuario pulsa el botón "Volver", se redirige a la página de inicio público.
 */
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Si el usuario pulsa "Registrarse", se redirige a la página de registro.
 */
if (isset($_REQUEST['registrarse'])) {
    $_SESSION['paginaEnCurso'] = 'registro';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Variable de control para validar si la entrada es correcta.
 * @var bool $entradaOK Indica si los datos ingresados son válidos.
 */
$entradaOK = true;

/**
 * Array que almacena los mensajes de error de validación del formulario.
 * @var array $aErrores Contiene los errores asociados a cada campo del formulario.
 */
$aErrores = [
    'usuario' => '',
    'password' => ''
];

/**
 * Si el usuario pulsa "Iniciar sesión", se procesa la autenticación.
 */
if (isset($_REQUEST['iniciarsesion'])) {
    $_SESSION['paginaAnterior'] = 'login';

    // Validar credenciales con la base de datos
    $oUsuarioActivo = UsuarioPDO::validarUsuario($_REQUEST['usuario'], $_REQUEST['password']);

    // Si el usuario no existe, marcamos error
    if (!isset($oUsuarioActivo)) {
        $entradaOK = false;
    }

    /**
     * Validaciones de los campos del formulario:
     * - Si la autenticación falla, se asigna un mensaje de error.
     * - Si es válida, se verifica que los datos cumplan con los requisitos de formato.
     */
    $aErrores = [
        'usuario' => (!$oUsuarioActivo) ? 'Error de autenticación.' : validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 32, 4, 1),
        'password' => (!$oUsuarioActivo) ? 'Error de autenticación.' : validacionFormularios::validarPassword($_REQUEST['password'], 32, 4, 2, 1)
    ];

    // Comprobar si hay errores en la validación
    foreach ($aErrores as $campo => $valor) {
        if ($valor != null) {
            $entradaOK = false; // Marcar que la entrada no es válida
            $_REQUEST[$campo] = ''; // Limpiar el campo con error
        }
    }
} else {
    // Si no se ha enviado el formulario, la entrada no es válida
    $entradaOK = false;
}

/**
 * Si la validación es exitosa:
 * - Se actualiza la fecha de última conexión del usuario.
 * - Se almacena el usuario en la sesión.
 * - Se redirige a la página privada.
 */
if ($entradaOK) {
    $oUsuarioActivo = UsuarioPDO::registrarUltimaConexion($oUsuarioActivo->getCodUsuario());

    $_SESSION['usuarioMiAplicacion'] = $oUsuarioActivo;
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';

    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
} else {
    /**
     * Si la validación falla, se recarga la vista de login con los errores correspondientes.
     */
    require_once $aVistas['layout'];
}

