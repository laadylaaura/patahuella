<section id="listadoNegocios" class="py-5" >
  <div class="container">
    <h2 class="mb-4">Lugares recomendados</h2>
    
    <div class="row g-4">
      <!-- Hotel Luna Canina -->
      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 rounded-4 overflow-hidden">
          <img src="ruta-a-tu-imagen-perro-con-gafas.jpg" class="card-img-top" height="200" alt="Hotel Luna Canina">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Hotel Luna Canina</h5>
              <div>
                <span class="badge bg-dark text-warning">4.5</span>
              </div>
            </div>
            <p class="card-text">El Hotel Luna Canina ofrece alojamiento cómodo y servicios especiales para ti y tu mascota, con áreas diseñadas para disfrutar juntos en un entorno acogedor.</p>
            <div class="mt-2">
              <span class="badge bg-secondary me-1">Pet friendly</span>
              <span class="badge bg-secondary">Alojamiento</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Parque canino el sol -->
      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 rounded-4 overflow-hidden">
          <img src="ruta-a-tu-imagen-perro-corriendo.jpg" class="card-img-top" height="200" alt="Parque canino el sol">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Hotel Sol Canino </h5>
              <div>
                <span class="badge bg-dark text-warning">4.8</span>
              </div>
            </div>
            <p class="card-text">El Parque Canino del Sol es un lugar perfecto para pasear con tu perro, con amplias zonas de césped, senderos y espacios diseñados para que tu mascota juegue libremente.</p>
            <div class="mt-2">
              <span class="badge bg-secondary me-1">Aire libre</span>
              <span class="badge bg-secondary">Juegos</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Restaurante Buenavista -->
      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 rounded-4 overflow-hidden">
          <img src="ruta-a-tu-imagen-persona-con-perro.jpg" class="card-img-top" height="200" alt="Restaurante Buenavista">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Restaurante Buenavista</h5>
              <div>
                <span class="badge bg-dark text-warning">4.2</span>
              </div>
            </div>
            <p class="card-text">El Restaurante La Buenavista acepta perros y ofrece un espacio cómodo donde tanto tú como tu mascota pueden disfrutar de una comida relajada en su terraza pet-friendly.</p>
            <div class="mt-2">
              <span class="badge bg-secondary me-1">Restaurante</span>
              <span class="badge bg-secondary">Terraza</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Últimas opiniones -->
    <h2 class="my-5">Últimas reseñas</h2>
    <div class="row g-4">
      <?php
      // Ejemplo de datos de reseñas (puedes reemplazar esto con datos reales de tu base de datos)
      $resenas = [
          [
              'tipo' => 'restaurante',
              'nombre' => 'Restaurante Buenavista',
              'usuario' => 'Juan Pérez',
              'resena' => 'Excelente lugar para disfrutar con mi perro. La terraza es muy cómoda.',
              'calificacion' => 4.5
          ],
          [
              'tipo' => 'alojamiento',
              'nombre' => 'Hotel Luna Canina',
              'usuario' => 'Ana López',
              'comentario' => 'El hotel es muy acogedor y tiene áreas especiales para mascotas.',
              'calificacion' => 4.8
          ],
          [
              'tipo' => 'restaurante',
              'nombre' => 'Restaurante La Terraza',
              'usuario' => 'Carlos Gómez',
              'comentario' => 'Buena comida, pero el espacio para mascotas es algo reducido.',
              'calificacion' => 3.8
          ],
      ];

      // Mostrar las reseñas
      foreach ($resenas as $resena): ?>
        <div class="col-md-4">
          <div class="card bg-light h-100">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($resena['nombre']); ?> (<?php echo ucfirst($resena['tipo']); ?>)</h5>
              <h6 class="card-subtitle mb-2 text-muted">Por: <?php echo htmlspecialchars($resena['usuario']); ?></h6>
              <p class="card-text">"<?php echo htmlspecialchars($resena['resena']); ?>"</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-warning text-dark">Calificación: <?php echo $resena['calificacion']; ?></span>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>