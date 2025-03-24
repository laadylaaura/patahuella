<?php

class InicioControlador
{
    public function irAInicio()
    {
        $data = [];
        require_once("./vistas/Vista.php");
        $vista = new Vista();
        $vista->render("inicio", $data);
    }

    public function sesionLogin()
    {
        require_once('./lib/GestorSesiones.php');
        $ses = new GestorSesiones();
        
        // Si ya existe la sesión, redireccionar al perfil
        if($ses->existeSesion("CLAVE")){
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."listado/listarMiPerfil");
            exit();
        } else {
            // Mostrar el formulario de login
            require_once('./vistas/Vista.php');
            $data = [];
            $vista = new Vista();
            $vista->render("login", $data);
        }
    }
    
    public function validar()
    {
        // Eliminar los mensajes de depuración
        // echo "estoy en inicio validar";
        
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]))
        {
            require_once("./modelo/InicioModelo.php");
            $modelo = new InicioModelo();
            $resultado = $modelo->getvalidarUsuario($_POST["email"], $_POST["password"]);
            
            if ($resultado) // Si hay resultado (autenticación exitosa)
            {
                // Iniciar sesión
                require_once("./lib/GestorSesiones.php");
                $ses = new GestorSesiones();
                
                // Guardar ID en la sesión 
                $ses->crearSesion("CLAVE", $resultado);
                
                // Redireccionar
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: ".$route->getRuta()."Usuario/listarMiPerfil");
                exit();
            }  
            else {
                // Autenticación fallida
                $data = [];
                $data["errorvalidacion"] = "El usuario o contraseña son incorrectos.";
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("login", $data);
            }
        }
        else {
            // Datos incompletos
            $data = [];
            $data["errorvalidacion"] = "Debe completar todos los campos del formulario.";
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("login", $data);
        }
    }
    
    public function cerrarSesion()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();
        $ses->destruirSesion();
        
        require_once("./config/Enrutador.php");
        $route = new Enrutador();
        header("Location: ".$route->getRuta());
        exit();
    }
}
?>