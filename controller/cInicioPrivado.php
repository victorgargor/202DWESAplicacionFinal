<?php
/**
 * Controlador de la página de inicio privado.
 * 
 * Gestiona la autenticación del usuario, la navegación entre diferentes secciones
 * y la generación de un mensaje de bienvenida basado en el idioma y las conexiones previas.
 * 
 * @author Víctor García Gordón
 * @version 10/01/2025
 */

// Verificamos si el usuario está autenticado, si no, lo redirigimos al login.
if (empty($_SESSION['usuarioMiAplicacion'])) {
    $_SESSION['paginaEnCurso'] = 'login';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Manejo de navegación según la acción solicitada.

/**
 * Redirige a la vista de detalles del usuario.
 */
if (isset($_REQUEST['detalle'])) {
    $_SESSION['paginaEnCurso'] = 'detalle';
    $_SESSION['paginaAnterior'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Simula un error en la consulta SQL a la base de datos.
 */
if (isset($_REQUEST['error'])) {
    $_SESSION['paginaAnterior'] = 'inicioPrivado';
    $consulta = "SELECT * FRPM T04_DepartamentosActivos"; // Error intencional en la consulta
    DBPDO::ejecutarConsulta($consulta);
    exit();
}

/**
 * Redirige a la API REST de la aplicación.
 */
if (isset($_REQUEST['rest'])) {
    $_SESSION['paginaEnCurso'] = 'api';
    $_SESSION['paginaAnterior'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Redirige al mantenimiento de departamentos.
 */
if (isset($_REQUEST['mtodepartamentos'])) {
    $_SESSION['paginaEnCurso'] = 'mtodep';
    $_SESSION['paginaAnterior'] = 'inicioPrivado';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

/**
 * Cierra la sesión y redirige al login.
 */
if (isset($_REQUEST['cerrarsesion'])) {
    session_destroy();
    header("Location: indexLoginLogoff.php");
    exit();
}

/**
 * Obtiene el idioma de la cookie.
 * Si no está definido, se usa español ('es') por defecto.
 * 
 * @var string $idioma
 */
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

/**
 * Obtiene el objeto del usuario autenticado desde la sesión.
 * 
 * @var Usuario $oUsuarioActivo
 */
$oUsuarioActivo = $_SESSION['usuarioMiAplicacion'];

/**
 * Obtiene los datos del usuario autenticado.
 * 
 * @var string $nombreUsuario Nombre del usuario.
 * @var int $numConexiones Número de veces que el usuario se ha conectado.
 * @var string $fechaUltimaConexion Fecha y hora de la última conexión.
 */
$nombreUsuario = $oUsuarioActivo->getDescUsuario();
$numConexiones = $oUsuarioActivo->getNumAccesos() + 1;
$fechaUltimaConexion = $oUsuarioActivo->getFechaHoraUltimaConexion();

/**
 * Formatea la fecha de la última conexión del usuario.
 * 
 * @var string $fechaUltimaConexionFormateada Fecha formateada en "d/m/Y H:i:s".
 */
$fechaUltimaConexionFormateada = date("d/m/Y H:i:s", strtotime($fechaUltimaConexion));

/**
 * Mensajes de bienvenida en diferentes idiomas.
 * 
 * @var array<string, array<string, string>> $mensajesBienvenida
 */
$mensajesBienvenida = [
    'es' => [
        'primera_vez' => "¡Bienvenido <b> &nbsp;{nombre} </b>! Esta es la primera vez que te conectas.",
        'vuelta' => "¡Bienvenido de nuevo <b>&nbsp;{nombre}</b>! Esta es la <b>&nbsp;{numConexiones}&nbsp;</b> vez que te conectas y te conectaste por última vez el <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>."
    ],
    'en' => [
        'primera_vez' => "Welcome <b> &nbsp;{nombre} </b>! This is the first time you have logged in.",
        'vuelta' => "Welcome back <b>&nbsp;{nombre}</b>! This is the <b>&nbsp;{numConexiones}&nbsp;</b> time you have logged in, and you last logged in on <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>."
    ],
    'pt' => [
        'primera_vez' => "Bem-vindo <b> &nbsp;{nombre} </b>! Esta é a primeira vez que você se conecta.",
        'vuelta' => "Bem-vindo de volta <b>&nbsp;{nombre}</b>! Esta é a <b>&nbsp;{numConexiones}&nbsp;</b> vez que você se conecta, e você se conectou pela última vez em <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>."
    ]
];

/**
 * Determina el mensaje de bienvenida basado en el número de conexiones del usuario.
 * 
 * @var string $mensaje Mensaje de bienvenida personalizado.
 */
$mensaje = ($numConexiones == 1) 
    ? $mensajesBienvenida[$idioma]['primera_vez'] 
    : $mensajesBienvenida[$idioma]['vuelta'];

// Reemplazar los marcadores de posición en el mensaje con los valores reales
$mensaje = str_replace(
    ['{nombre}', '{numConexiones}', '{fechaUltimaConexion}'],
    [$nombreUsuario, $numConexiones, $fechaUltimaConexionFormateada],
    $mensaje
);

/**
 * Array con los datos que se enviarán a la vista.
 * 
 * @var array<string, mixed> $datosVista
 */
$datosVista = [
    'mensajeBienvenida' => $mensaje,
    'nombreUsuario' => strtoupper($nombreUsuario), // Nombre en mayúsculas.
];

// Incluimos la vista principal.
require_once $aVistas['layout'];
