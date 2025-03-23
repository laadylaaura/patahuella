<?php
class Configuracion{

private static $instance = null;

private  $rutaServidor ="http://localhost/patahuella/" ;
private  $servidorBD ="localhost";
private  $usuarioBD ="root";
private  $passwordBD ="";
private  $nombreBD ="patayhuella";



public function __construct(Type $var = null) {
    $this->var = $var;
}

public function getRutaServidor(){
    return $this->rutaServidor ;
}

public function setRutaServidor($r){
    $this->rutaServidor=$r;
}

public function getServidorBD(){
    return $this->servidorBD ;
}

public function getUsuarioBD(){
    return $this->usuarioBD ;
}
public function getPasswordBD(){
    return $this->passwordBD ;
}
public function getnombreBD(){
    return $this->nombreBD ;
}

public static function getInstance()
{
  if (self::$instance == null)
  {
    self::$instance = new Configuracion();
  }

  return self::$instance;
}

}

?>