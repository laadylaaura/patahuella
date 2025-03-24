<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/header.css" rel="stylesheet">
  <title>Pata y huella</title>
</head>

<body>
  <?php
  require_once("./lib/GestorSesiones.php");
  $gestorSesiones = new GestorSesiones();
  $usuarioLogueado = $gestorSesiones->existeSesion("CLAVE");
  ?>
  <header class="sticky-header">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a href="<?php echo $ruta; ?>" class="navbar-brand d-flex align-items-center">
          <strong>Pata y huella</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $ruta; ?>">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $ruta; ?>restaurantes">Restaurantes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $ruta; ?>hoteles">Alojamientos</a>
            </li>
            <?php if ($usuarioLogueado): ?>
              <!-- Opciones para usuarios logueados -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $ruta; ?>usuario/listarMiPerfil">Mi Perfil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $ruta; ?>inicio/cerrarSesion">Cerrar sesión</a>
              </li>
            <?php else: ?>
              <!-- Opciones para usuarios no logueados -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $ruta; ?>inicio/sesionLogin">Iniciar sesión</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $ruta; ?>usuario/registro">Registrarse</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper"></div>