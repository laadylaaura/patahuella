<?php
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">
<!-- Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5 mb-5 pb-5">
  <h2 class="text-center mb-4 text-white text-decoration-underline">Registro</h2>
  
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card-f bg-light p-3 rounded">
        <div class="card-header bg-transparent border-0">
          <h4 class="mb-0 text-center">Crea tu cuenta</h4>
        </div>
        
        <div class="card-body">
          <?php if (isset($errores) && !empty($errores)): ?>
            <div class="alert alert-danger">
              <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          
          <?php if (isset($exito)): ?>
            <div class="alert alert-success">
              <?php echo $exito; ?>
            </div>
          <?php endif; ?>
          
          <form action="<?php echo $ruta; ?>usuario/registrar" method="post">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="nombre" name="nombre" 
                     value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>" 
                     placeholder="Tu nombre completo" required>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" 
                     value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" 
                     placeholder="nombre@ejemplo.com" required>
            </div>
            
            <div class="mb-3">
              <label for="contrasena" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" 
                     placeholder="Crea tu contraseña" required minlength="6">
              <div class="form-text">La contraseña debe tener al menos 6 caracteres.</div>
            </div>
            
            <div class="mb-4">
              <label for="confirmar_contrasena" class="form-label">Confirmar contraseña</label>
              <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" 
                     placeholder="Confirma tu contraseña" required minlength="6">
            </div>
            
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn2">Registrarme</button>
            </div>
          </form>
          
          <!-- Separador -->
          <div class="d-flex align-items-center my-4">
            <hr class="flex-grow-1">
            <span class="mx-3">o regístrate con</span>
            <hr class="flex-grow-1">
          </div>
        <div class="card-footer bg-transparent border-0 text-center">
          <p class="mb-0">¿Ya tienes una cuenta? <a href="<?php echo $ruta; ?>inicio/sesionLogin">Iniciar sesión</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>