/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 16/01/2025
 */
let indiceActual = 0;

function moverSlide(paso) {
    const archivos = document.querySelectorAll('.carrusel-pdf .pdf-item');
    const totalArchivos = archivos.length;

    // Elimina la clase 'active' de todos los elementos y oculta los contenedores
    archivos.forEach((archivo) => {
        archivo.classList.remove('active');
        const contenedor = archivo.querySelector('.pdf-container');
        if (contenedor) {
            contenedor.style.display = 'none';  // Oculta el contenedor del PDF
        }
    });

    // Calcula el nuevo índice
    indiceActual = (indiceActual + paso + totalArchivos) % totalArchivos;

    // Muestra el PDF correspondiente
    const archivoActivo = archivos[indiceActual];
    archivoActivo.classList.add('active');
    const contenedorActivo = archivoActivo.querySelector('.pdf-container');
    if (contenedorActivo) {
        contenedorActivo.style.display = 'block';  // Muestra el contenedor del PDF
    }

    // Cargar el PDF correspondiente
    const pdfUrls = [
        'doc/ArbolDeNavegación.pdf',
        'doc/CatalogoDeRequisitos.pdf',
        'doc/DiagramaDeCasosDeUso.pdf',
        'doc/DiagramaDeClases.pdf',
        'doc/EstructuraAlmacenamientoDWES.pdf',
        'doc/RelacionDeFicheros.pdf',
        'doc/SecuenciaDesarrolloCRUDcompleto.pdf',
        'doc/UsoDeLaSesion.pdf'
    ];

    const contenedorId = `pdf-container-${indiceActual + 1}`;
    cargarPDF(pdfUrls[indiceActual], contenedorId);
}

// Inicializar el carrusel cuando la página se haya cargado
document.addEventListener('DOMContentLoaded', () => {
    moverSlide(0);  // Cargar el primer PDF al cargar la página
});
