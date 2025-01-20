/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 16/01/2025
 */

function cargarPDF(pdfUrl, containerId) {
    const container = document.getElementById(containerId);
    if (!container) {
        console.error('Contenedor no encontrado: ' + containerId);
        return;
    }

    // Limpiar cualquier contenido previo del contenedor
    container.innerHTML = '';

    // Cargar el PDF usando PDF.js
    pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
        pdf.getPage(1).then(page => {
            // Obtener las dimensiones del contenedor para escalar el PDF
            const viewport = page.getViewport({ scale: 1 });

            // Crear un canvas para renderizar el PDF
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Establecer el tamaño del canvas para que ocupe todo el contenedor
            canvas.width = container.offsetWidth;
            canvas.height = container.offsetHeight;

            // Calcular la escala necesaria para que el PDF ocupe todo el canvas
            const scale = Math.min(canvas.width / viewport.width, canvas.height / viewport.height)*1.02;

            // Ajustar el viewport con la nueva escala
            const scaledViewport = page.getViewport({ scale: scale });

            // Renderizar la página en el canvas
            page.render({
                canvasContext: context,
                viewport: scaledViewport
            });

            // Insertar el canvas en el contenedor
            container.appendChild(canvas);
        });
    }).catch(err => {
        console.error('Error al cargar el PDF:', err);
    });
}

// Cargar los PDF en los respectivos contenedores
document.addEventListener("DOMContentLoaded", function() {
    cargarPDF('doc/ArbolDeNavegación.pdf', 'pdf-container-1');
    cargarPDF('doc/CatalogoDeRequisitos.pdf', 'pdf-container-2');
    cargarPDF('doc/DiagramaDeCasosDeUso.pdf', 'pdf-container-3');
    cargarPDF('doc/DiagramaDeClases.pdf', 'pdf-container-4');
    cargarPDF('doc/EstructuraAlmacenamientoDWES.pdf', 'pdf-container-5');
    cargarPDF('doc/RelacionDeFicheros.pdf', 'pdf-container-6');
    cargarPDF('doc/SecuenciaDesarrolloCRUDcompleto.pdf', 'pdf-container-7');
    cargarPDF('doc/UsoDeLaSesion.pdf', 'pdf-container-8');
});
