<?php

class InicioModelo
{
    public function __construct($var = null) {
        $this->var = $var;
    }
    public function getvalidarUsuario($email, $password)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Usuarios WHERE email = ? AND contrasena = ?";
        $resultado = $gbd->consultaLectura($consulta, $email, $password);

        if(is_array($resultado) && count($resultado) > 0) {
            return $resultado[0]['id_usuario'];
        }
        else {
            return false;
        }
    }
}
?>