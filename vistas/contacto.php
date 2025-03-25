<?php
include 'inc/header.php';
?>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/index.css" rel="stylesheet">
<section id="seccionContacto">
  <div class="container py-5" id="contenedorContacto">
    <div class="row">
      <div class="col-lg-6">
        <h1 class="display-4 fw-bold mb-4">¿Tienes dudas? ¡Hablemos!</h1>
        <p class="mb-4">En Pata y Huella, nuestro objetivo es ayudarte a disfrutar de los mejores momentos con tu perro, descubriendo hoteles, parques y restaurantes que sean amigables con ellos.</p>
        <p class="mb-4">Si tienes preguntas, sugerencias, o simplemente quieres contarnos tu experiencia, estamos aquí para escucharte. Tu opinión es muy importante para nosotros y para la comunidad de amantes de los perros.</p>
        <p class="mb-3">Cómo puedes contactarnos</p>
        <p class="mb-4">
          <i class="bi bi-envelope-fill me-2"></i> Correo electrónico: <a href="mailto:contacto@[tuweb].com">contacto@[tuweb].com</a>
        </p>
        <p class="mb-3">¿Quieres colaborar o proponer un lugar?</p>
        <p class="mb-4">Si conoces un lugar increíble para ir con tu perro y no está en nuestra lista, no dudes en decírnoslo. Juntos podemos hacer crecer esta comunidad perruna. 💕🐾</p>
      </div>
      <div class="col-lg-6">
        <div class="bg-light p-4 rounded">
          <h2 class="mb-4">Contacta con nosotros</h2>
          
          <!-- Mostrar mensajes de error o éxito si existen -->
          <?php if(isset($data["errorvalidacion"])): ?>
          <div class="alert alert-danger">
              <?php echo $data["errorvalidacion"]; ?>
          </div>
          <?php endif; ?>
          
          <?php if(isset($data["mensaje"])): ?>
          <div class="alert alert-<?php echo $data["tipo"]; ?>">
              <?php echo $data["mensaje"]; ?>
          </div>
          <?php endif; ?>
          
          <form action="<?php echo $ruta; ?>contacto/procesarContacto" method="POST" id="formularioContacto" novalidate>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aquí tu nombre" required>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribe aquí tus apellidos" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="nombre@email.com" required>
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje:</label>
              <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí" required></textarea>
            </div>
            <button type="submit" class="btn btn2">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include 'inc/footer.php';
?>

<!-- Nuestro script de validación con JavaScript puro -->
<script src="<?php echo $ruta; ?>assets/js/validacionContacto.js"></script>
