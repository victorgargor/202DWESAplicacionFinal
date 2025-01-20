<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 14/01/2025
 */
?>

<div class="detalle">
    <br/>
    <form method="POST">
        <input type="submit" name="aceptar" value="Aceptar">
    </form>
    <?php

    // Función para imprimir de manera ordenada las superglobales no vacías
    function mostrarSuperglobal($nombre, $variable) {
        if (!empty($variable)) {
            echo "<h2>$$nombre</h2>";
            echo '<table border="1" style="border-collapse: collapse;">';

            foreach ($variable as $key => $value) {
                // Verificamos si el valor es un objeto y lo convertimos a JSON
                if (is_object($value)) {
                    $value = json_encode($value, JSON_PRETTY_PRINT);
                }
                echo "<tr><td style='padding: 5px;'><strong>$key</strong></td><td style='padding: 5px;'>$value</td></tr>";
            }

            echo '</table>';
        }
    }

    // Comprobar que están llenas y mostrar las variables superglobales 
    if (!empty($_SESSION)) {
        mostrarSuperglobal('SESSION', $_SESSION);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_SESSION está vacía </h2>';
    }

    if (!empty($_COOKIE)) {
        mostrarSuperglobal('COOKIE', $_COOKIE);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_COOKIE está vacía </h2>';
    }

    if (!empty($_SERVER)) {
        mostrarSuperglobal('SERVER', $_SERVER);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_SERVER está vacía </h2>';
    }

    if (!empty($_GET)) {
        mostrarSuperglobal('GET', $_GET);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_GET está vacía </h2>';
    }

    if (!empty($_POST)) {
        mostrarSuperglobal('POST', $_POST);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_POST está vacía </h2>';
    }

    if (!empty($_FILES)) {
        mostrarSuperglobal('FILES', $_FILES);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_FILES está vacía </h2>';
    }

    if (!empty($_ENV)) {
        mostrarSuperglobal('ENV', $_ENV);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_ENV está vacía </h2>';
    }

    if (!empty($_REQUEST)) {
        mostrarSuperglobal('REQUEST', $_REQUEST);
    } else {
        echo '<h2 style="color:lightcoral;">La variable $_REQUEST está vacía </h2>';
    }

    // Mostrar la configuración de PHP            
    phpinfo();
    ?>
</div>