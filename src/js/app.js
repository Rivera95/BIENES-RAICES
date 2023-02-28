document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
});

function eventListeners() {
    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Numero teléfono:</label>
        <input type="tel" placeholder="Ingresa el numero del Teléfono" id="telefono" name="contacto[telefono]">

        <p>Eliga la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail:</label>
        <input type="email" placeholder="Ingresa el Email" id="email" name="contacto[email]" required>
        `;
    }
}