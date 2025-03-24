<?php
class ResenaControlador {
    public function agregarResena()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_resena = $_POST['id_resena'];
            $id_usuario = $_POST['id_usuario'];
            $id_negocio = $_POST['id_negocio'];
            $puntuacion = $_POST['puntuacion'];
            $comentario = $_POST['comentario'];
            $fecha_publicacion = $_POST['fecha_publicacion'];

            require_once("./modelo/CrearModelo.php");
            $modelo = new CrearModelo();
            $resultado = $modelo->insertarResena($id_resena, $id_usuario, $id_negocio, $puntuacion, $comentario, $fecha_publicacion);

            if ($resultado) {
                echo "Reseña agregada con éxito.";
            } else {
                echo "Error al agregar la reseña.";
            }
        } else {
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("agregarResena", []);
        }
    }

    public function listarResenasNegocio($id_negocio)
    {
        require_once("./modelo/ListadoModelo.php");
        $modelo = new ListadoModelo();
        $resenas = $modelo->getListadoResenasNegocio($id_negocio);

        require_once("./vistas/Vista.php");
        $vista = new Vista();
        $vista->render("listadoResenasNegocio", ["resenas" => $resenas]);
    }

    public function listarResenasUsuario($id_usuario)
    {
        require_once("./modelo/ListadoModelo.php");
        $modelo = new ListadoModelo();
        $resenas = $modelo->getListadoResenasUsuario($id_usuario);

        require_once("./vistas/index.php");
        $vista = new Vista();
        $vista->render("listadoResenasUsuario", ["resenas" => $resenas]);
    }
}

?>