<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos']; // Nuevo campo de apellidos
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Validar los datos (se pueden agregar más validaciones según sea necesario)
    if (empty($nombre) || empty($apellidos) || empty($email) || empty($mensaje)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Aquí puedes agregar la lógica para enviar el mensaje por email o guardarlo en la base de datos

    // Para enviar un email
    $to = "email@ejemplo.com"; // Reemplazaremos con nuestra dirección de email
    $subject = "Nuevo mensaje de contacto de $nombre $apellidos";
    $body = "Nombre: $nombre\nApellidos: $apellidos\nEmail: $email\n\nMensaje:\n$mensaje";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>