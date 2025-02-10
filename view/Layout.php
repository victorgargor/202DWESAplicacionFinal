<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['paginaEnCurso'] == 'inicioPublico') : ?>
            <link rel="stylesheet" href="webroot/css/modelos.css" type="text/css">
        <?php else: ?>
            <link rel="stylesheet" href="webroot/css/aplicacion.css" type="text/css">
        <?php endif; ?>
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <main>    
            <div class="center">
                <?php require_once $aVistas[$_SESSION['paginaEnCurso']]; ?>
            </div>
        </main>
        <footer>
            <div>
                <a><img src="webroot/media/images/logo.jpg" alt="logo" width="50px" height="50px"/></a>
                <a href="/index.html">Víctor García Gordón</a>
                <a href="doc/phpdoc/index.html">PHPDocumentor</a>
                <a target="blank" href="doc/curriculum.pdf"><img src="webroot/media/images/curriculum.jpg" alt="curriculum"></a>
                <a target="blank" href="https://github.com/victorgargor/202DWESAplicacionFinal"><img src="webroot/media/images/github.png" alt="github"></a>
                <a target="blank" href="https://github.com">Web Imitada</a>
                <a type="application/rss+xml" href="webroot/feed/feed.xml"><img src="webroot/media/images/rss.png" alt="rss"></a>
            </div>
        </footer>
    </body>
</html>