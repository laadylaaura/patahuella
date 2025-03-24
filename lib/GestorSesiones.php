<?php

class GestorSesiones
{
    public function __construct() {
        // Iniciar la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function crearSesion($clave, $valor)
    {
        $_SESSION[$clave] = $valor;
    }

    public function existeSesion($clave)
    {
        if (isset($_SESSION[$clave]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function obtenerValorDeSesion($clave)
    {
        return $_SESSION[$clave] ?? null;
    }
    
    public function destruirSesion()
    {
        session_unset();
        session_destroy();
    }
}



?>