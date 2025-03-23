<?php

// Datos del usuario (estos deben haber sido almacenados en sesión al registrarse o iniciar sesión)
$nombre    = $_SESSION['nombre']    ?? 'N/D';
$apellidos = $_SESSION['apellidos'] ?? 'N/D';
$email     = $_SESSION['email']     ?? 'N/D';

// Los favoritos se guardan en sesión mediante un array con dos claves: 'restaurantes' y 'alojamientos'
$favoritos = $_SESSION['favoritos'] ?? [
    'restaurantes' => [],
    'alojamientos' => []
];

include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-4 mb-4 pb-4">
  <h2 class="text-center text-white text-decoration-underline mb-5">Mi Perfil</h2>
  
  <div class="row mb-3">
    <!-- Columna de Datos Personales -->
    <div class="col-md-5">
      <!-- Caja para Datos Personales -->
      <div class="card h-100 border border-dark p-4 rounded mb-4">
        <h5 class="card-title text-center">Datos Personales</h5>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
        <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($apellidos); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        
        <!-- Botón para editar perfil -->
        <div class="mt-3">
          <a href="editar_perfil.php" class="btn btn2">Editar Perfil</a>
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
            <?php if (!empty($favoritos['restaurantes'])): ?>
              <?php foreach ($favoritos['restaurantes'] as $restaurante): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span><?php echo htmlspecialchars($restaurante['nombre']); ?></span>
                  <a href="eliminar_favorito.php?tipo=restaurante&amp;nombre=<?php echo urlencode($restaurante['nombre']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No tienes restaurantes favoritos.</p>
            <?php endif; ?>
          </div>

          <!-- Alojamientos Favoritos -->
          <div class="col-md-6">
            <h5 class="text-decoration-underline">Alojamientos</h5>
            <?php if (!empty($favoritos['alojamientos'])): ?>
              <?php foreach ($favoritos['alojamientos'] as $alojamiento): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span><?php echo htmlspecialchars($alojamiento['nombre']); ?></span>
                  <a href="eliminar_favorito.php?tipo=alojamiento&amp;nombre=<?php echo urlencode($alojamiento['nombre']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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