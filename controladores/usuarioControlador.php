<?php
class UsuarioControlador {

    public function __construct(Type $var = null) {
        $this->var = $var;
    }

    public function listarMiPerfil(){
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();
        
        if ($ses->existeSesion("CLAVE")) {
            $usuarioId = $ses->obtenerValorDeSesion("CLAVE");
            
            // Obtener datos del usuario desde la BD
            require_once("./modelo/UsuarioModelo.php");
            $modelo = new UsuarioModelo();
            $datosUsuario = $modelo->getObtenerUsuarioPorId($usuarioId);
            
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("mi_perfil", ["usuario" => $datosUsuario]);
        } else {
            // No hay sesión, redireccionar a login
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."inicio/sesionLogin");
            exit();
        }
    }
    
    public function registrar()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            require_once("./modelo/CrearModelo.php");
            $modelo = new CrearModelo();
            $resultado = $modelo->insertarUsuario($nombre, $email, $contrasena);

            if ($resultado) {
                echo "Usuario registrado con éxito.";
            } else {
                echo "Error al registrar el usuario.";
            }
        } else {
            require_once("./vistas/index.php");
            $vista = new Vista();
            $vista->render("registro", []);
        }
    }
}
?>