<?php
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">
<!-- Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5 mb-5 pb-5">
  <h2 class="text-center mb-4 text-white text-decoration-underline">Iniciar Sesión</h2>
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card-f bg-light p-3 rounded">
        <div class="card-header bg-transparent border-0">
          <h4 class="mb-0 text-center">Accede a tu cuenta</h4>
        </div>
        <div class="card-body">
          <?php if (isset($exito)): ?>
            <div class="alert alert-success">
                <?php echo $exito; ?>
            </div>
          <?php endif; ?>
          
          <?php if (isset($errorvalidacion)): ?>
            <div class="alert alert-danger">
                <?php echo $errorvalidacion; ?>
            </div>
          <?php endif; ?>
          
          <form action="<?php echo $ruta; ?>inicio/validar" method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
            </div>
            
            <div class="mb-4">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Escribe tu contraseña" required>
            </div>
            
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn2">Iniciar Sesión</button>
            </div>
          </form>
          
          <!-- Separador -->
          <div class="d-flex align-items-center my-4">
            <hr class="flex-grow-1">
            <span class="mx-3">o inicia sesión con</span>
            <hr class="flex-grow-1">
          </div>
          
          <!-- Botones de redes sociales -->
          <div class="d-grid gap-2">
            <a href="#" class="btn btn-primary d-flex align-items-center justify-content-center">
              <i class="fab fa-facebook-f me-2"></i> Facebook
            </a>
            <a href="#" class="btn btn-danger d-flex align-items-center justify-content-center">
              <i class="fab fa-google me-2"></i> Google
            </a>
            <a href="#" class="btn btn-dark d-flex align-items-center justify-content-center">
              <i class="fab fa-github me-2"></i> GitHub
            </a>
          </div>
        </div>
        
        <div class="card-footer bg-transparent border-0 text-center">
          <p class="mb-0">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>