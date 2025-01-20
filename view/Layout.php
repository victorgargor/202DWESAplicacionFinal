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
        <link rel="stylesheet" href="webroot/css/aplicacion.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <header>      
            <h1 id="inicio">APLICACIÓN FINAL</h1>
        </header>
        <main>  
            <p id="logo">
                <img src="doc/logo.jpg" alt="logo" width="50px" height="50px"/>
            </p>    
            <div class="center">
                <?php require_once $aVistas[$_SESSION['paginaEnCurso']];?>
            </div>
        </main>
        <footer>
            <div>
                <a><img src="doc/logo.jpg" alt="logo" width="50px" height="50px"/></a>
                <a href="/index.html">Víctor García Gordón</a>
                <a href="doc/index.html">PHPDocumentor</a>
                <a target="blank" href="doc/curriculum.pdf"><img src="doc/curriculum.jpg" alt="curriculum"></a>
                <a target="blank" href="https://github.com/victorgargor/202DWESAplicacionFinal"><img src="doc/github.png" alt="github"></a>
                <a target="blank" href="https://github.com">Web Imitada</a>
            </div>
        </footer>
    </body>
</html>