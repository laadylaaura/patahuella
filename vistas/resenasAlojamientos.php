<div class="container mt-4">
  <h2 class="h2-Res text-left text-white">Reseñas</h2>
  <div class="card">           
  <?php
  // Aquí obtenemos las reseñas de la base de datos
  // ...

  $resenas = [
      ['usuario' => 'Usuario1', 'resena' => 'Este alojamiento es increíble, muy cómodo para mi mascota.'],
      // Array de ejemplo con reseñas
  ];

  foreach ($resenas as $resena) {
      echo "<p><strong>" . $resena['usuario'] . ":</strong> " . $resena['resena'] . "</p>";
  }
  ?>

  <?php if (isset($_SESSION['usuario_id'])): ?>
  <h3>Escribir una reseña</h3>
  <form action="guardar_resena.php" method="post">
      <input type="hidden" name="tipo" value="alojamiento">
      <input type="hidden" name="nombre" value="<?php echo $alojamiento['nombre']; ?>">
      <textarea name="resena" required></textarea><br>
      <input type="submit" value="Enviar Reseña">
  </form>
  <?php else: ?>
  <p><a href="login.php">Inicia sesión</a> para escribir una reseña.</p>
  <?php endif; ?>
</div>