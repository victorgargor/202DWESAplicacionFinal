<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */
?>

<form>
    <input type="submit" name="login" value="Login">
</form>
<section class="content-container">
    <div class="carrusel">
        <div class="carrusel-pdf">
            <div class="pdf-item active">
                <div class="nombre-pdf">Arbol <br/>de Navegación</div>
                <div id="pdf-container-1" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Catálogo <br/>de Requisitos</div>
                <div id="pdf-container-2" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Diagrama <br/>de Casos de Uso</div>
                <div id="pdf-container-3" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Diagrama <br/>de Clases</div>
                <div id="pdf-container-4" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Estructura <br/>de Almacenamiento</div>
                <div id="pdf-container-5" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Relacion <br/>de Ficheros</div>
                <div id="pdf-container-6" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Secuencia <br/>Desarrollo CRUD</div>
                <div id="pdf-container-7" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
            <div class="pdf-item">
                <div class="nombre-pdf">Uso <br/>de la Sesión</div>
                <div id="pdf-container-8" class="pdf-container"></div> <!-- Contenedor para PDF -->
            </div>
        </div>
        <button class="prev" onclick="moverSlide(-1)">&#10094;</button>
        <button class="next" onclick="moverSlide(1)">&#10095;</button>
    </div>
    <script src="webroot/js/carrousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="webroot/js/controles.js"></script> <!-- Asegúrate de que este script esté después de PDF.js -->
</section>
<section>
    <div>
        <a class="españa" href="?idioma=es">
            <img src="doc/españa.png" alt="es">
        </a>
        <a class="inglaterra" href="?idioma=en">
            <img src="doc/inglaterra.png" alt="en">
        </a>
        <a class="portugal" href="?idioma=pt">
            <img src="doc/portugal.png" alt="pt">
        </a>
    </div>
    <script src="webroot/js/banderas.js"></script>
</section>
