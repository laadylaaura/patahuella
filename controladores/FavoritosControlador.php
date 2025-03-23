<?php
class FavoritosControlador {
    public function __construct(Type $var = null) {
        $this->var = $var;
    }

    public function listarFavoritos()
    {
        require_once('./lib/GestorSesiones.php');
        $ses = new GestorSesiones();
        
        if($ses->existeSesion("CLAVE")){
            require_once("./modelo/FavoritosModelo.php");
            $modelo = new FavoritosModelo();
            $data = $modelo->obtenerFavoritos($ses->getSesion("CLAVE"));
            
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("favoritos", $data);
        } else {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."inicio/sesionLogin");
            exit();
        }
    }

    public function agregarFavorito()
    {
        require_once('./lib/GestorSesiones.php');
        $ses = new GestorSesiones();
        
        if($ses->existeSesion("CLAVE")){
            if(isset($_POST["id_producto"])){
                require_once("./modelo/FavoritosModelo.php");
                $modelo = new FavoritosModelo();
                $resultado = $modelo->agregarFavorito($ses->getSesion("CLAVE"), $_POST["id_producto"]);
                
                if($resultado){
                    echo json_encode(["success" => true, "message" => "Producto agregado a favoritos"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error al agregar a favoritos"]);
                }
            }
        } else {
            echo json_encode(["success" => false, "message" => "Debe iniciar sesión"]);
        }
    }

    public function eliminarFavorito()
    {
        require_once('./lib/GestorSesiones.php');
        $ses = new GestorSesiones();
        
        if($ses->existeSesion("CLAVE")){
            if(isset($_POST["id_producto"])){
                require_once("./modelo/FavoritosModelo.php");
                $modelo = new FavoritosModelo();
                $resultado = $modelo->eliminarFavorito($ses->getSesion("CLAVE"), $_POST["id_producto"]);
                
                if($resultado){
                    echo json_encode(["success" => true, "message" => "Producto eliminado de favoritos"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error al eliminar de favoritos"]);
                }
            }
        } else {
            echo json_encode(["success" => false, "message" => "Debe iniciar sesión"]);
        }
    }
}
?>