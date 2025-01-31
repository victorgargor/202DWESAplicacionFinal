<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 29/01/2025
 */
// Redirige a la página del login si se pulsa el botón
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: indexLoginLogoff.php');
    exit();
}

// Inicializar variables
$entradaOK = true;
$aErrores = [
    'codigo' => '',
    'password' => '',
    'descripcion' => ''
];

// Verificar si el formulario ha sido enviado
if (isset($_REQUEST['registrarse'])) {
    // Establecer la página anterior como 'registro'
    $_SESSION['paginaAnterior'] = 'registro';
    
    // Si los campos son válidos, proceder con el registro
    if ($entradaOK) {
        try {
            $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';
            // Comprobar si el código de usuario ya existe
            $usuarioExistente = UsuarioPDO::validarCodNoExiste($codigo);
            if ($usuarioExistente) {
                $aErrores['codigo'] = 'El código de usuario ya existe.';
                $entradaOK = false;
            } else {
                // Registrar el usuario en la base de datos
                $registroExitoso = UsuarioPDO::altaUsuario($_REQUEST['codigo'], $_REQUEST['password'], $_REQUEST['descripcion']);

                if ($registroExitoso) {
                    $_SESSION['mensaje'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
                    $_SESSION['paginaEnCurso'] = 'login';  // Redirigir a la página de login
                    header('Location: indexLoginLogoff.php');
                    exit();
                } else {
                    $aErrores['codigo'] = 'Hubo un error al registrar el usuario. Por favor, inténtelo más tarde.';
                    $entradaOK = false;
                }
            }
        } catch (Exception $e) {
            // En caso de error, capturamos la excepción y mostramos el mensaje
            $aErrores['codigo'] = 'Error inesperado en el registro. Inténtelo más tarde.';
            $entradaOK = false;
            $error = new ErrorApp($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), 'registro.php');
            $error->logError();
        }
    }
} else {
    // Si la entrada no es correcta, recargamos la vista del registro con los errores
    $codigo = '';
    $password = '';
    $descUsuario = '';
}

// Mostrar el formulario de registro con los posibles errores
require_once $aVistas['layout'];
