
<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 10/01/2025
 */

// Verificamos si el usuario está autenticado
if (empty($_SESSION['usuarioMiAplicacion'])) {
    $_SESSION['paginaEnCurso'] = 'login';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si se pulsa el botón de detalle
if (isset($_REQUEST['detalle'])) {
    $_SESSION['paginaEnCurso'] = 'detalle';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si se pulsa el botón de detalle
if (isset($_REQUEST['error'])) {
    $consulta = "SELECT * FRPM T04_DepartamentosActivos";
    DBPDO::ejecutarConsulta($consulta);
    exit();
}

// Si se pulsa el botón de detalle
if (isset($_REQUEST['rest'])) {
    $_SESSION['paginaEnCurso'] = 'wip';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Si se pulsa el botón de detalle
if (isset($_REQUEST['mtodepartamentos'])) {
    $_SESSION['paginaEnCurso'] = 'wip';
    require_once $aControladores[$_SESSION['paginaEnCurso']];
    exit();
}

// Cerramos la sesión
if (isset($_REQUEST['cerrarsesion'])) {
    session_destroy();
    header("Location: indexLoginLogoff.php");
    exit();
}

// Obtener el idioma de la cookie, si no está establecida, se usa 'es' como predeterminado
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';


// Obtener el objeto completo del usuario desde la sesión
$oUsuarioActivo = $_SESSION['usuarioMiAplicacion'];

// Obtener los datos del usuario
$nombreUsuario = $oUsuarioActivo->getDescUsuario(); // Cambié el acceso directo por el getter
$numConexiones = $oUsuarioActivo->getNumAccesos() + 1; // Cambié el acceso directo por el getter
$fechaUltimaConexion = $oUsuarioActivo->getFechaHoraUltimaConexion(); // Cambié el acceso directo por el getter

// Formatear la fecha de la última conexión
$fechaUltimaConexionFormateada = date("d/m/Y H:i:s", strtotime($fechaUltimaConexion));

// Definir los mensajes de bienvenida en los distintos idiomas
$mensajesBienvenida = [
    'es' => [
        'primera_vez' => "¡Bienvenido <b> &nbsp;{nombre} </b>! Esta es la primera vez que te conectas.",
        'vuelta' => "¡Bienvenido de nuevo <b>&nbsp;{nombre}</b>! Esta es la <b>&nbsp;{numConexiones}&nbsp;</b> vez que te conectas y te conectaste por última vez el <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ],
    'en' => [
        'primera_vez' => "Welcome <b> &nbsp;{nombre} </b>! This is the first time you have logged in.",
        'vuelta' => "Welcome back <b>&nbsp;{nombre}</b>! This is the <b>&nbsp;{numConexiones}&nbsp;</b> time you have logged in, and you last logged in on <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ],
    'pt' => [
        'primera_vez' => "Bem-vindo <b> &nbsp;{nombre} </b>! Esta é a primeira vez que você se conecta.",
        'vuelta' => "Bem-vindo de volta <b>&nbsp;{nombre}</b>! Esta é a <b>&nbsp;{numConexiones}&nbsp;</b> vez que você se conecta, e você se conectou pela última vez em <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ]
];

// Determinar el mensaje a mostrar en función del número de conexiones
if ($numConexiones == 1) {
    // Primera vez que el usuario se conecta
    $mensaje = $mensajesBienvenida[$idioma]['primera_vez'];
} else {
    // No es la primera vez
    $mensaje = $mensajesBienvenida[$idioma]['vuelta'];
}

// Reemplazar los marcadores de posición en el mensaje con los valores reales
$mensaje = str_replace(
    ['{nombre}', '{numConexiones}', '{fechaUltimaConexion}'],
    [$nombreUsuario, $numConexiones, $fechaUltimaConexionFormateada],
    $mensaje
);

// Array con los datos que se enviarán a la vista
$datosVista = [
    'mensajeBienvenida' => $mensaje,
    'nombreUsuario' => strtoupper($nombreUsuario), // Nombre en mayúsculas
];

// Incluimos la vista
require_once $aVistas['layout'];
