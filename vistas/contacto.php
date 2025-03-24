<?php
include '../vistas/inc/header.php';
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
          <form>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" placeholder="Escribe aquí tu nombre">
              </div>
              <div class="col-md-6">
                <label for="surname" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="surname" placeholder="Escribe aquí tus apellidos">
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="nombre@email.com">
            </div>
            <div class="mb-3">
              <label for="textarea" class="form-label">Mensaje:</label>
              <textarea class="form-control" id="textarea" rows="5" placeholder="Escribe tu mensaje aquí"></textarea>
            </div>
            <button type="submit" class="btn btn2">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include '../vistas/inc/footer.php';
?>
