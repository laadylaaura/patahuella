<!-- filepath: c:\xampp\htdocs\patayhuella-1\vistas\editar_perfil.php -->
<?php
session_start();

// Cargar los datos actuales del usuario desde la sesión
$nombre    = $_SESSION['nombre']    ?? '';
$apellidos = $_SESSION['apellidos'] ?? '';
$email     = $_SESSION['email']     ?? '';

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y actualizar los datos
    $nuevo_nombre    = htmlspecialchars($_POST['nombre']);
    $nuevos_apellidos = htmlspecialchars($_POST['apellidos']);
    $nuevo_email     = htmlspecialchars($_POST['email']);

    // Guardar los datos actualizados en la sesión
    $_SESSION['nombre']    = $nuevo_nombre;
    $_SESSION['apellidos'] = $nuevos_apellidos;
    $_SESSION['email']     = $nuevo_email;

    // Redirigir al perfil después de guardar los cambios
    header('Location: mi_perfil.php');
    exit;
}

include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">

<div class="container mt-4 mb-5 pb-5">
  <h2 class="text-center mb-4 text-white text-decoration-underline">Editar Perfil</h2>
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card-f bg-light p-3 rounded">
        <div class="card-header bg-transparent border-0">
          <h4 class="mb-0 text-center">Actualiza tus datos</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="editar_perfil.php">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            
            <div class="mb-3">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn2">Guardar Cambios</button>
              <a href="mi_perfil.php" class="btn btn-secondary">Cancelar</a>
            </div>
          </form>
        </div>
        
        <div class="card-footer bg-transparent border-0 text-center">
          <p class="mb-0"><small>Actualiza tus datos personales manteniendo tu email actualizado</small></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>