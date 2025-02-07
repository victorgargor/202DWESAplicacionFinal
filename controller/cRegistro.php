<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 29/01/2025
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
 * Inicializa las variables para manejar el estado del formulario y los errores.
 * $entradaOK indica si la entrada es válida.
 * $aErrores almacena los mensajes de error para cada campo del formulario.
 */
$entradaOK = true;
$aErrores = [
    'codigo' => '',
    'password' => '',
    'descripcion' => ''
];

/**
 * Verifica si el formulario de registro ha sido enviado.
 * Si se ha enviado, valida los datos y procesa el registro.
 */
if (isset($_REQUEST['registrarse'])) {
    // Establece la página anterior como 'registro' para redirigir después en caso de error
    $_SESSION['paginaAnterior'] = 'registro';

    /**
     * Si la entrada es válida, se procede con el registro del nuevo usuario.
     * Si hay algún error en el proceso de validación o registro, se detiene el proceso.
     */
    if ($entradaOK) {
        try {
            // Obtiene el código de usuario enviado por el formulario
            $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';

            // Verifica si el código de usuario ya existe en la base de datos
            $usuarioExistente = UsuarioPDO::validarCodNoExiste($codigo);
            if ($usuarioExistente) {
                // Si el código de usuario ya existe, se agrega un mensaje de error
                $aErrores['codigo'] = 'El código de usuario ya existe.';
                $entradaOK = false;
            } else {
                // Si el código es único, se procede a registrar al usuario en la base de datos
                $registroExitoso = UsuarioPDO::altaUsuario($_REQUEST['codigo'], $_REQUEST['password'], $_REQUEST['descripcion']);

                if ($registroExitoso) {
                    // Si el registro fue exitoso, se muestra un mensaje y se redirige al login
                    $_SESSION['mensaje'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
                    $_SESSION['paginaEnCurso'] = 'login';  // Redirige a la página de login
                    header('Location: indexLoginLogoff.php');
                    exit();
                } else {
                    // Si hubo un error al registrar el usuario, se muestra un mensaje de error
                    $aErrores['codigo'] = 'Hubo un error al registrar el usuario. Por favor, inténtelo más tarde.';
                    $entradaOK = false;
                }
            }
        } catch (Exception $e) {
            /**
             * Si ocurre una excepción durante el proceso de registro, se captura el error.
             * Se muestra un mensaje genérico y se loguea el error para su posterior revisión.
             */
            $aErrores['codigo'] = 'Error inesperado en el registro. Inténtelo más tarde.';
            $entradaOK = false;

            // Se crea un objeto ErrorApp para registrar el error
            $error = new ErrorApp($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), 'registro.php');
            $error->logError();
        }
    }
} else {
    /**
     * Si el formulario no ha sido enviado o la entrada es inválida, se inicializan los campos
     * para mostrar un formulario de registro vacío con los errores correspondientes.
     */
    $codigo = '';
    $password = '';
    $descUsuario = '';
}

/**
 * Muestra el formulario de registro con los posibles mensajes de error almacenados
 * en el array $aErrores.
 */
require_once $aVistas['layout'];
