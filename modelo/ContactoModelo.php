<?php
class ContactoModelo
{
    public function __construct($var = null) {
        $this->var = $var;
    }
    
   
    public function guardarMensaje($nombre, $apellido, $email, $mensaje)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        $fecha_envio = date('Y-m-d H:i:s');
        
        $leido = 0;
        $respondido = 0;
        $fecha_respuesta = null;
        
    
        $id_usuario = null;
        
        $sqlInsertar = "INSERT INTO Contactos (id_usuario, nombre, apellido, email, mensaje, fecha_envio, leido, respondido, fecha_respuesta) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $resultado = $gbd->consultaInsercion(
            $sqlInsertar, 
            $id_usuario, 
            $nombre, 
            $apellido, 
            $email, 
            $mensaje, 
            $fecha_envio, 
            $leido, 
            $respondido, 
            $fecha_respuesta
        );
        
        return $resultado;
    }
  
    /*
    public function marcarComoLeido($id_contacto)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        $consulta = "UPDATE Contactos SET leido = 1 WHERE id_contacto = ?";
        $resultado = $gbd->consultaUpdate($consulta, $id_contacto);
        
        return $resultado;
    }
    
  
    public function marcarComoRespondido($id_contacto)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        $fecha_respuesta = date('Y-m-d H:i:s');
        $consulta = "UPDATE Contactos SET respondido = 1, fecha_respuesta = ? WHERE id_contacto = ?";
        $resultado = $gbd->consultaUpdate($consulta, $fecha_respuesta, $id_contacto);
        
        return $resultado;
    }
          */
}
?> 