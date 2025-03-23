<?php
// Establecer el código de estado HTTP
http_response_code(500);

// Incluir header
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-5 mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <div class="card-f bg-light p-5 rounded">
        <h1 class="display-1 text-danger mb-4">500</h1>
        <h2 class="mb-4">Error interno del servidor</h2>
        <p class="lead mb-4">Lo sentimos, ha ocurrido un error en nuestro servidor.</p>
        <p class="mb-5">Estamos trabajando para solucionar este problema lo antes posible. Por favor, inténtalo de nuevo más tarde.</p>
        
        <div class="d-flex justify-content-center gap-3">
          <a href="javascript:history.back()" class="btn btn-outline-primary">Volver atrás</a>
          <a href="../index.php" class="btn btn-outline-secondary">Ir al inicio</a>
        </div>
        
        <!-- Imagen de mascota triste -->
        <div class="mt-5">
          <img src="../assets/imagenesNegocio/error-dog.jpg" alt="Mascota triste" class="img-fluid" style="max-height: 200px;">
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>