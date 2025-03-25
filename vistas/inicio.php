<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Pata y Huella</title>


    <link href="<?php echo $ruta; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>assets/css/index.css" rel="stylesheet">
  </head>
  <body>


<?php
session_start();
?>
<?php
require_once('./vistas/inc/header.php');
?>

<?php
require_once('./vistas/inc/welcome.php');
?>

<?php
require_once('./vistas/recomendados.php');
?>

<?php
require_once('./vistas/inc/footer.php');
?>