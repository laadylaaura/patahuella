<?php
class Configuracion{

private static $instance = null;


private  $rutaServidor  ;
private  $servidorBD;
private  $usuarioBD ;
private  $passwordBD ;
private  $nombreBD ;



public function __construct(Type $var = null) {

    if (file_exists("preproducion.txt")){
        echo("preproduccion");
        $this->rutaServidor= "pruebaspatahuella.infy.uk";
        $this->servidorBD= "sql109.infinityfree.com";
        $this->usuarioBD="f0_38869378" ;
        $this->passwordBD= "kc57M5kSBO";
        $this->nombreBD= "if0_38869378_pruebaspatahuella";   
    }
    else if (file_exists("produccion.txt")){
        echo("proooo");
        $this->rutaServidor= "http://patahuella.42web.io/";
        $this->servidorBD= "sql312.infinityfree.com";
        $this->usuarioBD="if0_38876893" ;
        $this->passwordBD= "nebEyY54BcbO5SS";
        $this->nombreBD= "if0_38876893_produccionpatahuella";   
    }

    else {
        $this->rutaServidor= "http://localhost/patahuella/";
        $this->servidorBD= "localhost";
        $this->usuarioBD="root" ;
        $this->passwordBD= "";
        $this->nombreBD= "patayhuella";   
    }
    
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