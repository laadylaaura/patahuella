<?php
class NegocioModelo
{

    public function __construct(Type $var = null)
    {
        $this->var = $var;
    }

    //Obtenemos listado de negocios
    public function getListadoNegocios()
    {
        require_once(__DIR__ . "/../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Negocios";
        $resultado = $gbd->consultaLectura($consulta);

        return $resultado;
    }

    public function getNegocioPorId($id_negocio){
        require_once(__DIR__ . "/../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Negocios WHERE id_negocio = ?";
        $resultado = $gbd->consultaLectura($consulta, $id_negocio);

        return $resultado;
    }


    //Obtenemos listado de negocios por tipo
    public function getListadoTipoNegocio($tipo)
    {
        require_once(__DIR__ . "/../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Negocios WHERE tipo_negocio = ?";

        // Usamos -> para llamar al método de instancia
        $resultado = $gbd->consultaLectura($consulta, $tipo);

        return $resultado;
    }

    //Obtenemos los recomendados
        public function getNegocioRecomendado() {
            require_once(__DIR__ . "/../lib/GestorBD.php");
            $gbd = new GestorBD();
            
            $consulta = "SELECT 
                            n.id_negocio,
                            n.nombre,
                            n.tipo_negocio,
                            n.ciudad,
                            n.direccion,
                            AVG(r.puntuacion) AS puntuacion_promedio,
                            COUNT(r.id_resena) AS total_resenas
                        FROM 
                            Negocios n
                        JOIN 
                            Resenas r ON n.id_negocio = r.id_negocio
                        WHERE 
                            n.activo = TRUE
                        GROUP BY 
                            n.id_negocio, n.nombre, n.tipo_negocio, n.ciudad, n.direccion
                        HAVING 
                            COUNT(r.id_resena) > 0
                        ORDER BY 
                            puntuacion_promedio DESC";
            
            $resultado = $gbd->consultaLectura($consulta);
            return $resultado;
    }

    // Devuelve un array con los url de las 4 imagenes del negocio
    public function getImagenesporNegocio($id_negocio)
    {
        require_once(__DIR__ . "/../lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM ImagenesNegocios WHERE id_negocio = ? ORDER BY num_imagen ASC";
        $resultado = $gbd->consultaLectura($consulta, $id_negocio);

        return $resultado;
    }

    // Obtiene la imagen de Portada
    public function getImagenPrincipalNegocio($id_negocio)
    {
        require_once(__DIR__ . "/../lib/GestorBD.php");
        $gbd = new GestorBD();
        // Asumo que num_imagen = 1 es la imagen principal
        $consulta = "SELECT * FROM ImagenesNegocio WHERE id_negocio = ? AND num_imagen = 1 LIMIT 1";
        $resultado = $gbd->consultaLectura($consulta, $id_negocio);

        if (is_array($resultado) && count($resultado) > 0) {
            return $resultado[0];
        } else {
            return false;
        }
    }

}

?>