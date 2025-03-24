<?php
require_once("./lib/GestorSesiones.php");
$ses = new GestorSesiones();

if (!$ses->existeSesion("CLAVE")) {
    // Si no hay sesión, redirigir al login
    require_once("./config/Enrutador.php");
    $route = new Enrutador();
    header("Location: ".$route->getRuta()."inicio/sesionLogin");
    exit();
}

// Recoger datos mediante GET
$tipo = $_GET['tipo'] ?? '';
$id_negocio = $_GET['id'] ?? '';

if (!empty($tipo) && !empty($id_negocio)) {
    // Obtener el ID del usuario de la sesión
    $usuarioId = $ses->obtenerValorDeSesion("CLAVE");

    // Incluir el modelo de favoritos
    require_once("./modelo/FavoritosModelo.php");
    $modeloFavoritos = new FavoritoModelo();
    
    // Intentar eliminar el favorito
    if ($modeloFavoritos->getEliminarFavorito($usuarioId, $id_negocio)) {
        // Redirigir de vuelta al perfil con mensaje de éxito
        require_once("./config/Enrutador.php");
        $route = new Enrutador();
        header("Location: ".$route->getRuta()."usuario/listarMiPerfil?mensaje=eliminado");
    } else {
        // Redirigir de vuelta al perfil con mensaje de error
        require_once("./config/Enrutador.php");
        $route = new Enrutador();
        header("Location: ".$route->getRuta()."usuario/listarMiPerfil?error=eliminacion");
    }
} else {
    // Si no hay parámetros, redirigir al perfil
    require_once("./config/Enrutador.php");
    $route = new Enrutador();
    header("Location: ".$route->getRuta()."usuario/listarMiPerfil");
}
exit();
?>