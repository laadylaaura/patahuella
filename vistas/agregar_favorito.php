<?php
session_start();

// Recoger datos mediante GET
$tipo   = $_GET['tipo'] ?? '';
$nombre = $_GET['nombre'] ?? '';

if (!empty($tipo) && !empty($nombre)) {
    // Inicializar favoritos en sesión si no existen
    if (!isset($_SESSION['favoritos'])) {
        $_SESSION['favoritos'] = [
            'restaurantes' => [],
            'alojamientos' => []
        ];
    }

    // Agregar el favorito según el tipo
    if ($tipo === 'restaurante') {
        // Se puede almacenar más información, por defecto se almacena el nombre.
        $_SESSION['favoritos']['restaurantes'][] = ['nombre' => $nombre];
    } elseif ($tipo === 'alojamiento') {
        $_SESSION['favoritos']['alojamientos'][] = ['nombre' => $nombre];
    }
}

// Redirigir al perfil para ver los favoritos actualizados
header("Location: mi_perfil.php");
exit();
?>