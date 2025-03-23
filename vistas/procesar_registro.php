<?php
include 'inc/header.php';

// Recoger y limpiar los datos enviados
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');

$email     = trim($_POST['email'] ?? '');
$password  = trim($_POST['password'] ?? '');

$error = '';

// Validaciones
if(empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
    $error = "Todos los campos son obligatorios.";
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "El correo electrónico no es válido.";
}
if(strlen($password) < 6) {
    $error = "La contraseña debe tener al menos 6 caracteres.";
}

if(!empty($error)) {
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-danger">' . $error . '</div>';
    echo '<a href="registro.php" class="btn btn-secondary">Volver</a>';
    echo '</div>';
    include 'footer.php';
    exit;
}

// Aquí incluimos la lógica para insertar el registro en la base de datos
// Por ahora, simularemos una inserción exitosa

// Si la inserción es exitosa, mostramos un mensaje de éxito:
echo '<div class="container mt-4">';
echo '<div class="alert alert-success">Registro exitoso, ' . htmlspecialchars($nombre) . '!</div>';
echo '<a href="index.php" class="btn btn-primary">Ir al inicio</a>';
echo '</div>';

include 'inc/footer.php';
?>