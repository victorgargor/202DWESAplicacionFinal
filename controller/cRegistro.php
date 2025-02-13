<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 13/02/2025
 */

/**
 * Redirige a la página de login si el usuario pulsa el botón "volver".
 * Establece la página en curso como 'login' y realiza la redirección.
 */
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: indexLoginLogoff.php');
    exit();
}

/**
 * Inicializa la variable de control
 * $entradaOK indica si la entrada es válida.
 * $aErrores almacena los mensajes de error para cada campo del formulario.
 */

// Inicializamos la variable de control
$entradaOK = true;

// Inicializamos los errores de validación (vacíos inicialmente)
$aErrores = [
    'codigo' => '',
    'password' => '',
    'descripcion' => ''
];

// Comprobamos si el formulario ha sido enviado
if (isset($_REQUEST['registrarse'])) {
    $_SESSION['paginaAnterior'] = 'registro';

    // Obtenemos los datos enviados
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : '';

    // Validamos cada campo y actualizamos los errores en caso de que haya alguno
    // Verificamos si el código cumple con los requisitos de formato
    if (validacionFormularios::comprobarAlfaNumerico($codigo, 32, 4, 1) != null) {
        $aErrores['codigo'] = 'El código de usuario debe ser alfanumérico y tener entre 4 y 32 caracteres.';
        $entradaOK = false; // Marcamos como no válido
    }

    // Verificamos si la contraseña cumple con los requisitos de formato
    if (validacionFormularios::validarPassword($password, 32, 4, 2, 1) != null) {
        $aErrores['password'] = 'La contraseña debe tener al menos 4 caracteres.';
        $entradaOK = false; // Marcamos como no válido
    }

    // Verificamos si la descripción cumple con los requisitos de formato
    if (validacionFormularios::comprobarAlfaNumerico($descripcion, 255, 4, 1) != null) {
        $aErrores['descripcion'] = 'La descripción no puede ser vacía y debe tener un máximo de 255 caracteres.';
        $entradaOK = false; // Marcamos como no válido
    }

    // Si no hubo errores, validamos el código de usuario en la base de datos
    if ($entradaOK) {
        try {
            // Verificamos si el código de usuario ya existe
            $usuarioExistente = UsuarioPDO::validarCodNoExiste($codigo);
            if ($usuarioExistente) {
                $aErrores['codigo'] = 'El código de usuario ya existe.';
                $entradaOK = false; // Marcamos como no válido
            } else {
                // Si el código es único, registramos al usuario en la base de datos
                $registroExitoso = UsuarioPDO::altaUsuario($codigo, $password, $descripcion);

                if ($registroExitoso) {
                    // Si el registro es exitoso, se inicia sesión automáticamente
                    $_SESSION['mensaje'] = '¡Registro exitoso! Ahora serás redirigido a tu página privada.';
                    $_SESSION['usuarioMiAplicacion'] = UsuarioPDO::validarUsuario($codigo, $password);  // Inicia sesión automáticamente
                    $_SESSION['paginaEnCurso'] = 'inicioPrivado';  // Redirigimos a la página privada
                    require_once $aControladores[$_SESSION['paginaEnCurso']]; // Redirigimos al controlador de la página privada
                    exit();
                } else {
                    $aErrores['codigo'] = 'Hubo un error al registrar el usuario. Por favor, inténtelo más tarde.';
                    $entradaOK = false; // Marcamos como no válido
                }
            }
        } catch (Exception $e) {
            $aErrores['codigo'] = 'Error inesperado en el registro. Inténtelo más tarde.';
            $entradaOK = false; // Marcamos como no válido

            // Se registra el error en el log
            $error = new ErrorApp($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $_SESSION['paginaAnterior']);
            $error->logError();
        }
    }
}

/**
 * Muestra el formulario de registro con los posibles mensajes de error almacenados
 * en el array $aErrores, solo si el formulario fue enviado.
 */
require_once $aVistas['layout'];



