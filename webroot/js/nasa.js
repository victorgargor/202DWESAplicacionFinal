/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 28/01/2025
 */
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el elemento de entrada de fecha
    const fechaInput = document.getElementById('fechaNasa');
    
    // Escuchar el evento de cambio (cuando el usuario seleccione una nueva fecha)
    fechaInput.addEventListener('change', function() {
        // Obtener la fecha seleccionada
        const fechaSeleccionada = fechaInput.value;
        
        // Crear un formulario dinámico
        const form = document.createElement('form');
        form.method = 'POST';  // Establecer el método POST
        form.action = window.location.href;  // Acción: enviar a la misma página
        
        // Crear un campo oculto para la fecha seleccionada
        const inputFecha = document.createElement('input');
        inputFecha.type = 'hidden';
        inputFecha.name = 'fechaNasa';
        inputFecha.value = fechaSeleccionada;
        
        // Agregar el campo oculto al formulario
        form.appendChild(inputFecha);
        
        // Agregar el formulario al documento
        document.body.appendChild(form);
        
        // Enviar el formulario automáticamente
        form.submit();
    });
});
