<!-- filepath: c:\xampp\htdocs\patayhuella-1\vistas\editar_perfil.php -->
<?php
require_once("./lib/GestorSesiones.php");
$ses = new GestorSesiones();

if (!$ses->existeSesion("CLAVE")) {
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
    require_once("./config/Enrutador.php");
    $route = new Enrutador();
    header("Location: ".$route->getRuta()."usuario/listarMiPerfil?error=usuario_no_encontrado");
    exit();
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
          <form method="POST" action="<?php echo $ruta; ?>usuario/editarPerfil">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" 
                     value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="email" name="email" 
                     value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            
            <div class="mb-3">
              <label for="contrasena" class="form-label">Nueva Contraseña (dejar en blanco para mantener la actual)</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" minlength="6">
              <div class="form-text">La contraseña debe tener al menos 6 caracteres.</div>
            </div>
            
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn2">Guardar Cambios</button>
              <a href="<?php echo $ruta; ?>usuario/listarMiPerfil" class="btn btn-secondary">Cancelar</a>
            </div>
          </form>
        </div>
        

      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>