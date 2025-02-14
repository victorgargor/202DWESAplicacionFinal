/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 13/02/2025
 */
document.addEventListener('DOMContentLoaded', async function () {
  // Rutas de los dos PDFs (uno para cada hero)
  const pdfUrls = [
    'doc/CatalogoDeRequisitos.pdf', // PDF para el primer hero (hero-pdf1)
    'doc/EstructuraAlmacenamientoDWES.pdf'         // PDF para el segundo hero (hero-pdf2)
  ];

  // Contenedores para los dos heroes
  const pdfContainers = [
    document.getElementById('pdfImages'),   // Contenedor del primer hero (hero-pdf1)
    document.getElementById('pdfImages2')   // Contenedor del segundo hero (hero-pdf2)
  ];

  // Número de páginas a cargar para cada hero
  const numPagesToLoad = 5;
  let zoomedImg = null;
  let isDragging = false, startX = 0, startY = 0, offsetX = 0, offsetY = 0;
  const scaleFactor = 2; // Factor de zoom

  // Cargar los PDFs y mostrarlos en cada contenedor
  for (let i = 0; i < pdfUrls.length; i++) {
    const pdfUrl = pdfUrls[i];
    const pdfContainer = pdfContainers[i];

    try {
      const pdf = await pdfjsLib.getDocument(pdfUrl).promise;

      // Cargar las páginas del PDF
      for (let pageNum = 1; pageNum <= numPagesToLoad; pageNum++) {
        const page = await pdf.getPage(pageNum);
        const scale = 2; // Aumenta la resolución de la imagen
        const viewport = page.getViewport({ scale });

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        await page.render({ canvasContext: context, viewport }).promise;

        // Convertimos el canvas en imagen
        const img = document.createElement('img');
        img.src = canvas.toDataURL('image/png');
        img.dataset.page = pageNum;
        img.classList.add('pdf-page'); // Clase para identificar las páginas
        pdfContainer.appendChild(img);
      }
    } catch (error) {
      console.error(`Error cargando el PDF ${pdfUrl}:`, error);
    }
  }

  // Evento de click para aplicar/quitar el zoom
  pdfContainers.forEach(pdfContainer => {
    pdfContainer.addEventListener('click', (e) => {
      if (e.target.tagName !== 'IMG') return;
      const img = e.target;

      // Si ya hay una imagen con zoom, la quitamos antes de aplicar otro zoom
      if (zoomedImg && zoomedImg !== img) {
        resetZoom(zoomedImg);
      }

      if (zoomedImg === img) {
        // Si es la misma imagen, quitamos el zoom
        resetZoom(img);
        return;
      }

      // Activamos el zoom en la imagen seleccionada
      zoomedImg = img;
      img.classList.add('zoomed');
      img.style.zIndex = '10'; // Poner la imagen encima de las demás

      // Centramos la imagen en la pantalla
      centerZoom(img);
    });
  });

  // Función para centrar la imagen al hacer zoom
  function centerZoom(img) {
    const viewportWidth = window.innerWidth;
    const viewportHeight = window.innerHeight;

    const imgRect = img.getBoundingClientRect();
    const imgCenterX = imgRect.left + imgRect.width / 2;
    const imgCenterY = imgRect.top + imgRect.height / 2;

    // Desplazamiento necesario para centrar la imagen
    offsetX = (viewportWidth / 2) - imgCenterX;
    offsetY = (viewportHeight / 2) - imgCenterY;

    img.style.transformOrigin = "center center";
    img.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(${scaleFactor})`;
  }

  // Función para resetear el zoom
  function resetZoom(img) {
    img.classList.remove('zoomed');
    img.style.transform = 'scale(1)';
    img.style.zIndex = '1';
    zoomedImg = null;
  }

  // Eventos para mover la imagen si está en zoom (panning)
  pdfContainers.forEach(pdfContainer => {
    pdfContainer.addEventListener('mousedown', (e) => {
      if (!zoomedImg) return;
      isDragging = true;
      startX = e.clientX;
      startY = e.clientY;
      zoomedImg.style.cursor = 'grabbing';
    });

    window.addEventListener('mousemove', (e) => {
      if (!isDragging || !zoomedImg) return;
      const dx = e.clientX - startX;
      const dy = e.clientY - startY;
      zoomedImg.style.transform = `translate(${offsetX + dx}px, ${offsetY + dy}px) scale(${scaleFactor})`;
    });

    window.addEventListener('mouseup', () => {
      if (zoomedImg) {
        zoomedImg.style.cursor = 'grab';
      }
      isDragging = false;
    });
  });

  // Eliminamos el scroll con la rueda del ratón
});



