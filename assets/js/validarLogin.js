document.addEventListener('DOMContentLoaded', function() {
    // Obtener el formulario de login
    const form = document.querySelector('form[action*="inicio/validar"]');
    
    if (form) {
        // Escuchar el evento submit
        form.addEventListener('submit', function(event) {
            // Limpiar mensajes de error previos
            document.querySelectorAll('.error-mensaje').forEach(msg => msg.remove());
            
            let formValido = true;
            
            // Validar email
            const email = document.getElementById('email');
            if (!email.value.trim()) {
                mostrarError(email, 'El correo electrónico es obligatorio');
                formValido = false;
            } else if (!validarFormatoEmail(email.value.trim())) {
                mostrarError(email, 'El formato del correo electrónico no es válido');
                formValido = false;
            }
            
            // Validar contraseña
            const password = document.getElementById('password');
            if (!password.value.trim()) {
                mostrarError(password, 'La contraseña es obligatoria');
                formValido = false;
            }
            
            // Si el formulario no es válido, prevenir el envío
            if (!formValido) {
                event.preventDefault();
            }
        });
    }
    
    // Función para mostrar mensaje de error
    function mostrarError(campo, mensaje) {
        campo.classList.add('border-danger');
        const divError = document.createElement('div');
        divError.className = 'error-mensaje text-danger mt-1';
        divError.textContent = mensaje;
        campo.parentNode.appendChild(divError);
    }
    
    // Validar formato de email con expresión regular simple
    function validarFormatoEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
}); 