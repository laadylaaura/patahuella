<?php
class ResenaModelo{

public function __construct(Type $var = null) {
    $this->var = $var;
}
public function getInsertarResena($id_resena, $id_usuario, $id_negocio, $puntuacion, $comentario, $fecha_publicacion)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();

        // Primero verificamos si ya existe una reseña de este usuario para este negocio
        $sqlVerificar = "SELECT COUNT(*) FROM Resenas WHERE id_usuario = ? AND id_negocio = ?";
        $resultado = $gbd->consultaLectura($sqlVerificar, $id_usuario, $id_negocio);

        // Si ya existe una reseña de este usuario para este negocio, retornamos false
        if ($resultado > 0) {
            return false;
        }

        // Si no existe, insertamos la nueva reseña
        $sqlInsertar = "INSERT INTO Resenas VALUES(?, ?, ?, ?, ?, ?)";
        $resultado = $gbd->consultaInsercion($sqlInsertar, $id_resena, $id_usuario, $id_negocio, $puntuacion, $comentario, $fecha_publicacion);

        // Retornamos true si la inserción fue exitosa
        return ($resultado !== false);
    }

    // Obtenemos listado de resenas por negocio
    public function getListadoResenasNegocio($id_negocio)
    {
        require_once("../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Resenas WHERE id_negocio = ? ";
        $resultado = $gbd->consultaLectura($consulta, $id_negocio);

        return $resultado;
    }

    // Obtenemos listado de resenas por usuario
    public function getListadoResenasUsuario($id_usuario)
    {
        require_once("../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Resenas WHERE id_usuario = ? ";
        $resultado = $gbd->consultaLectura($consulta, $id_usuario);

        return $resultado;
    }

    //obtenemos las ultimas resenas
    public function getUltimasResenas($limite = 10)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        $consulta = "SELECT * FROM Resenas ORDER BY fecha_publicacion DESC LIMIT ?";
        
        $resultado = $gbd->consultaLectura($consulta, $limite);
        
        return $resultado;
    }

    public function getEliminarResena($id_resena){
        require_once("../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "DELETE  FROM Resenas WHERE id_resena = ?";

        $resultado = $gbd->consultaEliminar($consulta, $id_usuario);

        return $resultado;

    }

}
?>