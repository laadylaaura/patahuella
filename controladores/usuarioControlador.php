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
    
    public function editarPerfil()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();
        
        if (!$ses->existeSesion("CLAVE")) {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."inicio/sesionLogin");
            exit();
        }

        $usuarioId = $ses->obtenerValorDeSesion("CLAVE");
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : null;

            require_once("./modelo/UsuarioModelo.php");
            $modelo = new UsuarioModelo();
            
            if ($modelo->getUpdateUsuario($usuarioId, $nombre, $email, $contrasena)) {
                // Redirigir al perfil con mensaje de éxito
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: ".$route->getRuta()."usuario/listarMiPerfil?mensaje=actualizado");
            } else {
                // Redirigir al perfil con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: ".$route->getRuta()."usuario/listarMiPerfil?error=actualizacion");
            }
            exit();
        }

        // Obtener datos actuales del usuario
        require_once("./modelo/UsuarioModelo.php");
        $modelo = new UsuarioModelo();
        $usuario = $modelo->getObtenerUsuarioPorId($usuarioId);

        if (!$usuario) {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."usuario/listarMiPerfil?error=usuario_no_encontrado");
            exit();
        }

        // Mostrar el formulario de edición
        require_once("./vistas/Vista.php");
        $vista = new Vista();
        $vista->render("editar_perfil", ["usuario" => $usuario]);
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

    public function eliminarFavorito()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();
        
        if (!$ses->existeSesion("CLAVE")) {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."inicio/sesionLogin");
            exit();
        }

        if (isset($_GET['id']) && isset($_GET['tipo'])) {
            $id_negocio = $_GET['id'];
            $usuarioId = $ses->obtenerValorDeSesion("CLAVE");

            require_once("./modelo/FavoritosModelo.php");
            $modeloFavoritos = new FavoritoModelo();
            
            if ($modeloFavoritos->getEliminarFavorito($usuarioId, $id_negocio)) {
                // Redirigir de vuelta al perfil con mensaje de éxito
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: ".$route->getRuta()."usuario/listarMiPerfil?mensaje=eliminado");
            } else {
                // Redirigir de vuelta al perfil con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: ".$route->getRuta()."usuario/listarMiPerfil?error=eliminacion");
            }
        } else {
            // Si no hay parámetros, redirigir al perfil
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."usuario/listarMiPerfil");
        }
        exit();
    }
}
?>