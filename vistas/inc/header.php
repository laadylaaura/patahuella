<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <title>Pata y huella</title>
</head>
<body>
<?php
require_once("./lib/GestorSesiones.php");
$gestorSesiones = new GestorSesiones();
$usuarioLogueado = $gestorSesiones->existeSesion("CLAVE");
?>
<header>
  <div class="navbar">
    <div class="container">
      <a href="<?php echo $ruta; ?>" class="navbar-brand d-flex align-items-center">
        <strong>Pata y huella</strong>
      </a>
      
      <div class="d-flex">
      <strong>
        <ul class="navbar-nav flex-row ms-auto gap-3">
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
            <a class="nav-link" href="<?php echo $ruta; ?>favoritos/listarFovoritos">Favoritos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $ruta; ?>usuario/listarMiPerfil">Mi Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $ruta; ?>inicio/cerrarSesion">Cerrar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Registrarse</a>
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
</strong>
      </div>
    </div>
  </div>
</header>

<div class="content-wrapper">
