/**
 * Validación del formulario de contacto con JavaScript puro
 * Este script maneja la validación del lado del cliente para el formulario de contacto
 */

document.addEventListener('DOMContentLoaded', function() {
  // Obtener referencia al formulario
  const formulario = document.getElementById('formularioContacto');
  
  // Obtener referencias a los campos del formulario
  const nombre = document.getElementById('nombre');
  const apellido = document.getElementById('apellido');
  const email = document.getElementById('email');
  const mensaje = document.getElementById('mensaje');
  
  // Añadir evento para validar al enviar el formulario
  formulario.addEventListener('submit', function(e) {
    // Reiniciar validación
    limpiarErrores();
    
    let hayErrores = false;
    
    // Validar nombre
    if (nombre.value.trim() === '') {
      mostrarError(nombre, 'El nombre es obligatorio');
      hayErrores = true;
    } else if (nombre.value.trim().length < 2) {
      mostrarError(nombre, 'El nombre debe tener al menos 2 caracteres');
      hayErrores = true;
    }
    
    // Validar apellido
    if (apellido.value.trim() === '') {
      mostrarError(apellido, 'El apellido es obligatorio');
      hayErrores = true;
    } else if (apellido.value.trim().length < 2) {
      mostrarError(apellido, 'El apellido debe tener al menos 2 caracteres');
      hayErrores = true;
    }
    
    // Validar email
    if (email.value.trim() === '') {
      mostrarError(email, 'El email es obligatorio');
      hayErrores = true;
    } else if (!validarEmail(email.value.trim())) {
      mostrarError(email, 'Por favor, introduce un email válido');
      hayErrores = true;
    }
    
    // Validar mensaje
    if (mensaje.value.trim() === '') {
      mostrarError(mensaje, 'El mensaje es obligatorio');
      hayErrores = true;
    } else if (mensaje.value.trim().length < 10) {
      mostrarError(mensaje, 'El mensaje debe tener al menos 10 caracteres');
      hayErrores = true;
    }
    
    // Prevenir envío si hay errores
    if (hayErrores) {
      e.preventDefault();
    }
  });
  
  // Validación en tiempo real al salir del campo
  [nombre, apellido, email, mensaje].forEach(function(campo) {
    campo.addEventListener('blur', function() {
      // Limpiar error de este campo
      campo.classList.remove('is-invalid');
      const errorExistente = campo.nextElementSibling;
      if (errorExistente && errorExistente.classList.contains('invalid-feedback')) {
        errorExistente.remove();
      }
      
      // Validar según el tipo de campo
      switch(campo.id) {
        case 'nombre':
        case 'apellido':
          if (campo.value.trim() === '') {
            mostrarError(campo, 'Este campo es obligatorio');
          } else if (campo.value.trim().length < 2) {
            mostrarError(campo, 'Debe tener al menos 2 caracteres');
          }
          break;
        case 'email':
          if (campo.value.trim() === '') {
            mostrarError(campo, 'El email es obligatorio');
          } else if (!validarEmail(campo.value.trim())) {
            mostrarError(campo, 'Por favor, introduce un email válido');
          }
          break;
        case 'mensaje':
          if (campo.value.trim() === '') {
            mostrarError(campo, 'El mensaje es obligatorio');
          } else if (campo.value.trim().length < 10) {
            mostrarError(campo, 'El mensaje debe tener al menos 10 caracteres');
          }
          break;
      }
    });
  });
  
  // Función para mostrar errores
  function mostrarError(campo, mensaje) {
    campo.classList.add('is-invalid');
    
    const errorElement = document.createElement('div');
    errorElement.className = 'invalid-feedback error-mensaje';
    errorElement.textContent = mensaje;
    
    // Insertar después del campo
    campo.parentNode.insertBefore(errorElement, campo.nextSibling);
  }
  
  // Función para limpiar todos los errores
  function limpiarErrores() {
    const camposConError = document.querySelectorAll('.is-invalid');
    const mensajesError = document.querySelectorAll('.error-mensaje');
    
    camposConError.forEach(function(campo) {
      campo.classList.remove('is-invalid');
    });
    
    mensajesError.forEach(function(mensaje) {
      mensaje.remove();
    });
  }
  
  // Función para validar email
  function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
}); 