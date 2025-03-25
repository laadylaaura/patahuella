document.addEventListener('DOMContentLoaded', function() {
    // Obtener el formulario de registro
    const form = document.querySelector('form[action*="usuario/registrar"]');
    
    if (form) {
        // Escuchar el evento submit
        form.addEventListener('submit', function(event) {
            // Limpiar mensajes de error previos
            document.querySelectorAll('.error-mensaje').forEach(msg => msg.remove());
            document.querySelectorAll('.border-danger').forEach(campo => {
                campo.classList.remove('border-danger');
            });
            
            let formValido = true;
            
            // Validar nombre
            const nombre = document.getElementById('nombre');
            if (!nombre.value.trim()) {
                mostrarError(nombre, 'El nombre es obligatorio');
                formValido = false;
            }
            
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
            const contrasena = document.getElementById('contrasena');
            if (!contrasena.value.trim()) {
                mostrarError(contrasena, 'La contraseña es obligatoria');
                formValido = false;
            } else if (contrasena.value.length < 6) {
                mostrarError(contrasena, 'La contraseña debe tener al menos 6 caracteres');
                formValido = false;
            }
            
            // Validar confirmación de contraseña
            const confirmarContrasena = document.getElementById('confirmar_contrasena');
            if (!confirmarContrasena.value.trim()) {
                mostrarError(confirmarContrasena, 'Debes confirmar la contraseña');
                formValido = false;
            } else if (confirmarContrasena.value !== contrasena.value) {
                mostrarError(confirmarContrasena, 'Las contraseñas no coinciden');
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