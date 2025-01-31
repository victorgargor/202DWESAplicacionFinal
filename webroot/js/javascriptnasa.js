/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 31/01/2025
 */
const apiKey = "G0efsc0nhZCxCJUliziDhKh5tUhrWKbHbPfB9oTa";
const baseUrl = "https://api.nasa.gov/planetary/apod";

// Función para mostrar la foto y la descripción
function mostrarFoto(data) {
    const foto = document.getElementById("foto");
    const descripcion = document.getElementById("descripcion");

    foto.src = data.url;
    descripcion.textContent = data.explanation;

    // Mostrar u ocultar el error si no hay imagen
    if (data.media_type !== "image") {
        foto.style.display = "none";
        descripcion.textContent = "Hoy no hay una imagen disponible, pero hay un video. Aquí te mostramos la descripción.";
    } else {
        foto.style.display = "block";
    }
}

// Función para obtener la foto del día
function obtenerFoto(fecha) {
    const url = `${baseUrl}?api_key=${apiKey}&date=${fecha}`;

    fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener la foto del día.");
                }
                return response.json();
            })
            .then(data => {
                mostrarFoto(data);
                document.getElementById("error-message").textContent = ''; // Limpiar mensaje de error
            })
            .catch(error => {
                document.getElementById("error-message").textContent = "Error: " + error.message;
                console.error(error);
            });
}

// Obtener la foto del día actual al cargar la página
obtenerFoto(new Date().toISOString().split('T')[0]); // Formato YYYY-MM-DD
