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

// Obtener el ID del usuario de la sesión
$usuarioId = $ses->obtenerValorDeSesion("CLAVE");

// Obtener datos del usuario desde la BD
require_once("./modelo/UsuarioModelo.php");
$modelo = new UsuarioModelo();
$usuario = $modelo->getObtenerUsuarioPorId($usuarioId);

if (!$usuario) {
    // Si no se encuentra el usuario, redirigir al login
    require_once("./config/Enrutador.php");
    $route = new Enrutador();
    header("Location: ".$route->getRuta()."inicio/sesionLogin");
    exit();
}

// Obtener favoritos desde la BD
require_once("./modelo/FavoritosModelo.php");
$modeloFavoritos = new FavoritoModelo();
$favoritos = $modeloFavoritos->getListadoFavoritos($usuarioId);

// Debug: Imprimir los favoritos recibidos
echo "<!-- Debug: Favoritos recibidos: " . print_r($favoritos, true) . " -->";

// Separar favoritos por tipo
$favoritosSeparados = [
    'restaurantes' => [],
    'alojamientos' => []
];

foreach ($favoritos as $negocio) {
    // Debug: Imprimir cada negocio que se está procesando
    echo "<!-- Debug: Procesando negocio: " . print_r($negocio, true) . " -->";
    
    if (isset($negocio['tipo_negocio'])) {
        if ($negocio['tipo_negocio'] === 'restaurante') {
            $favoritosSeparados['restaurantes'][] = $negocio;
        } else if ($negocio['tipo_negocio'] === 'hotel') {
            $favoritosSeparados['alojamientos'][] = $negocio;
        }
    }
}

// Debug: Imprimir los favoritos separados
echo "<!-- Debug: Favoritos separados: " . print_r($favoritosSeparados, true) . " -->";

include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-4 mb-4 pb-4">
  <h2 class="text-center text-white text-decoration-underline mb-5">Mi Perfil</h2>
  
  <?php if (isset($mensajes['exito'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $mensajes['exito']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($mensajes['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $mensajes['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="row mb-3">
    <!-- Columna de Datos Personales -->
    <div class="col-md-5">
      <!-- Caja para Datos Personales -->
      <div class="card h-100 border border-dark p-4 rounded mb-4">
        <h5 class="card-title text-center">Datos Personales</h5>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        
        <!-- Botón para editar perfil -->
        <div class="mt-3">
          <a href="<?php echo $ruta; ?>usuario/editarPerfil" class="btn btn2">Editar Perfil</a>
        </div>
      </div>
    </div>

    <!-- Columna de Favoritos -->
    <div class="col-md-7">
      <!-- Caja para Favoritos -->
      <div class="card h-100 border border-dark p-4 rounded">
        <h3 class="card-title text-center">Mis Favoritos</h3>
        <div class="row">
          <!-- Restaurantes Favoritos -->
          <div class="col-md-6">
            <h5 class="text-decoration-underline">Restaurantes</h5>
            <?php if (!empty($favoritosSeparados['restaurantes'])): ?>
              <?php foreach ($favoritosSeparados['restaurantes'] as $restaurante): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span><?php echo htmlspecialchars($restaurante['nombre']); ?></span>
                  <a href="<?php echo $ruta; ?>usuario/eliminarFavorito?tipo=restaurante&amp;id=<?php echo urlencode($restaurante['id_negocio']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No tienes restaurantes favoritos.</p>
            <?php endif; ?>
          </div>

          <!-- Alojamientos Favoritos -->
          <div class="col-md-6">
            <h5 class="text-decoration-underline">Alojamientos</h5>
            <?php if (!empty($favoritosSeparados['alojamientos'])): ?>
              <?php foreach ($favoritosSeparados['alojamientos'] as $alojamiento): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span><?php echo htmlspecialchars($alojamiento['nombre']); ?></span>
                  <a href="<?php echo $ruta; ?>usuario/eliminarFavorito?tipo=alojamiento&amp;id=<?php echo urlencode($alojamiento['id_negocio']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No tienes alojamientos favoritos.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'inc/footer.php';
?>