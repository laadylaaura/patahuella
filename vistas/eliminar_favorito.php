<?php
session_start();

// Recoger datos mediante GET
$tipo = $_GET['tipo'] ?? '';
$nombre = $_GET['nombre'] ?? '';

if (!empty($tipo) && !empty($nombre)) {
    // Determinar la clave de sesión según el tipo
    $clave = ($tipo === 'restaurante') ? 'restaurantes' : 'alojamientos';

    if (isset($_SESSION['favoritos'][$clave]) && is_array($_SESSION['favoritos'][$clave])) {
        // Buscar el elemento que coincida con el nombre enviado
        foreach ($_SESSION['favoritos'][$clave] as $index => $item) {
            if ($item['nombre'] === urldecode($nombre)) {
                unset($_SESSION['favoritos'][$clave][$index]);
                // Reindexar el array para evitar huecos
                $_SESSION['favoritos'][$clave] = array_values($_SESSION['favoritos'][$clave]);
                break;
            }
        }
    }
}

header("Location: mi_perfil.php");
exit();
?>