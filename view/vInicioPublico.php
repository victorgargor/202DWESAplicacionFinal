<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 08/01/2025
 */
?>
<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg" id="heroBg"></div> 
</div>

<!-- Nuevo hero con imágenes del PDF -->
<div class="hero hero-pdf" id="heroPdf">
  <div class="pdf-images" id="pdfImages">
    <!-- Aquí se insertarán las imágenes dinámicamente -->
  </div>
</div>

<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg2" id="heroBg2"></div> 
</div>

<!-- Nuevo hero con el tercer fondo -->
<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg3" id="heroBg3"></div> 
</div>

<!-- Nuevo hero con el cuarto fondo -->
<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg4" id="heroBg4"></div> 
</div>

<!-- Segundo hero con fondo PDF 
<div class="hero hero-pdf2" id="heroPdf2">
  <div class="pdf-images" id="pdfImages2">
     Aquí se insertarán las imágenes dinámicamente para el segundo hero 
  </div>
</div> -->

<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg5" id="heroBg5"></div> 
</div>

<!-- Nuevo hero con el sexto fondo -->
<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg6" id="heroBg6"></div> 
</div>

<!-- Nuevo hero con el séptimo fondo -->
<div class="hero" id="hero">
  <!-- Elemento hijo que muestra la imagen -->
  <div class="hero__bg7" id="heroBg7"></div> 
</div>

<form method="post">
    <input type="submit" name="login" value="Login">
</form>

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

<script src="webroot/js/zoom.js"></script>
<!-- Cargar pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="webroot/js/pdfToImages.js"></script>

