<?php
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">
<!-- Añadir Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-4 mb-5 pb-5">
  <h2 class="text-center mb-4 text-white text-decoration-underline">Registro</h2>
  
  <!-- Contenedor centrado con ancho máximo -->
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card-f bg-light p-3">
        <form method="post" action="procesar_registro.php">
          <div class="mb-3 text-black">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre">
          </div>
          <div class="mb-3 text-black">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Tus apellidos">
          </div>
          <div class="mb-3 text-black">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com">
          </div>
          <div class="mb-3 text-black">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn2">Registrarse</button>
          </div>
        </form>
        
        <!-- Separador -->
        <div class="text-center my-3">
          <span class="bg-light px-2">o regístrate con</span>
          <hr class="mt-0">
        </div>
        
        <!-- Botones de registro social -->
        <div class="d-flex justify-content-center gap-2 mb-3">
          <!-- Facebook -->
          <a href="auth/facebook_register.php" class="btn btn-primary">
            <i class="fab fa-facebook-f me-2"></i>Facebook
          </a>
          
          <!-- Google -->
          <a href="auth/google_register.php" class="btn btn-danger">
            <i class="fab fa-google me-2"></i>Google
          </a>
          
          <!-- GitHub -->
          <a href="auth/github_register.php" class="btn btn-dark">
            <i class="fab fa-github me-2"></i>GitHub
          </a>
        </div>
        
        <!-- Enlace para iniciar sesión -->
        <div class="text-center mt-3">
          <p class="mb-0">¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none">Inicia sesión</a></p>
        </div>
      </div>
    </div>
  </div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Registro de Usuario</h4>
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
                    
                  <form action="<?php echo $ruta; ?>usuario/registrar" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required minlength="6">
                            <div class="form-text">La contraseña debe tener al menos 6 caracteres.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="confirmar_contrasena" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required minlength="6">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Registrarme</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    ¿Ya tienes una cuenta? <a href="<?php echo $ruta; ?>inicio/sesionLogin">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php
include 'inc/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>