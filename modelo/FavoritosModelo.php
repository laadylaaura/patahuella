<?php

class FavoritoModelo{
    public function __construct(Type $var = null) {
        $this->var = $var;
    }


    public function getListadoFavoritos($id_usuario)
    {
        require_once("../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Favoritos WHERE id_usuario = ?";
        
        $resultado = $gbd->consultaLectura($consulta, $id_usuario);
        
        return $resultado;
    }

    // devuelve true o false si ha sido exitosa o no la insercion
    public function getAnadirFavoritos($id_usuario, $id_negocio)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();

        $consulta = "INSERT INTO Favoritos (id_usuario, id_negocio, fecha_creacion) VALUES (?, ?, NOW())";
        $resultado = $gbd->consultaInsercion($consulta, $id_usuario, $id_negocio);
        
        return $resultado;
    }

    public function getComprobarFavoritoExiste($id_usuario, $id_negocio)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        // Consulta para verificar si existe este favorito
        $consulta = "SELECT COUNT(*) as contador FROM Favoritos WHERE id_usuario = ? AND id_negocio = ?";
        $resultado = $gbd->consultaLectura($consulta, $id_usuario, $id_negocio);
        
        // Retorna true si ya existe este favorito
        if (is_array($resultado) && count($resultado) > 0 && $resultado[0]['contador'] > 0) {
            return true;
        }
        
        return false;
    }

    
    public function getEliminarFavorito($id_favorito){
        require_once("../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "DELETE  FROM Favoritos WHERE id_favorito = ?";

        $resultado = $gbd->consultaEliminar($consulta, $id_usuario);

        return $resultado;

    }

   
}
       