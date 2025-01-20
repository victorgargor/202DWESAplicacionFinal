/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 19/12/2024
 */

// Función para restaurar el tamaño original de las banderas
function restaurarTamanoOriginal() {
    const banderas = ['españa', 'inglaterra', 'portugal'];
    banderas.forEach(bandera => {
        const imagenBandera = document.querySelector(`.${bandera} img`);
        if (imagenBandera) {
            imagenBandera.style.transform = 'scale(1)'; // Restauramos el tamaño original
        }
    });
}

// Función para reducir el tamaño de las demás banderas
function reducirOtrasBanderas(claseBandera) {
    const banderas = ['españa', 'inglaterra', 'portugal'];
    banderas.forEach(bandera => {
        if (bandera !== claseBandera) {
            const imagenBandera = document.querySelector(`.${bandera} img`);
            if (imagenBandera) {
                imagenBandera.style.transform = 'scale(0.5)'; // Reducir otras banderas
            }
        }
    });
}

// Función para obtener el idioma desde la cookie
function obtenerIdiomaCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        cookie = cookie.trim();
        if (cookie.startsWith('idioma=')) {
            return cookie.substring('idioma='.length);
        }
    }
    return 'es'; // Valor predeterminado si no hay cookie
}

// Recuperar el idioma guardado al cargar la página
window.onload = function () {
    const idiomaGuardado = obtenerIdiomaCookie();

    // Restaurar tamaño de las banderas y reducir las otras según el idioma
    restaurarTamanoOriginal(); // Restauramos el tamaño de todas las banderas

    if (idiomaGuardado === 'es') {
        reducirOtrasBanderas('españa');
    } else if (idiomaGuardado === 'en') {
        reducirOtrasBanderas('inglaterra');
    } else if (idiomaGuardado === 'pt') {
        reducirOtrasBanderas('portugal');
    }
};

// Event listeners para cambiar el tamaño de la bandera y restaurar el tamaño de las otras
document.querySelector('.españa').addEventListener('click', function () {
    restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
    reducirOtrasBanderas('españa');
});

document.querySelector('.inglaterra').addEventListener('click', function () {
    restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
    reducirOtrasBanderas('inglaterra');
});

document.querySelector('.portugal').addEventListener('click', function () {
    restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
    reducirOtrasBanderas('portugal');
});

