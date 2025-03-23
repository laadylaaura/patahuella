<?php
// Establecer el código de estado HTTP
http_response_code(404);

// Incluir header
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-5 mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <div class="card-f bg-light p-5 rounded">
        <h1 class="display-1 text-warning mb-4">404</h1>
        <h2 class="mb-4">Página no encontrada</h2>
        <p class="lead mb-4">Lo sentimos, no pudimos encontrar la página que estás buscando.</p>
        <p class="mb-5">Es posible que la dirección se haya escrito incorrectamente o que la página se haya movido.</p>
        
        <div class="d-flex justify-content-center gap-3">
          <a href="javascript:history.back()" class="btn btn2">Volver atrás</a>
          <a href="../index.php" class="btn btn-outline-secondary">Ir al inicio</a>
        </div>
        
        <!-- Imagen de mascota confundida -->
        <div class="mt-5">
          <img src="../assets/imagenesNegocio/not-found-cat.jpg" alt="Mascota confundida" class="img-fluid" style="max-height: 200px;">
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>