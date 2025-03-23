<?php

require_once("./modelo/NegocioModelo.php");
require_once("./vistas/Vista.php");

class NegocioControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new NegocioModelo();
    }

    // Listado de negocios
    public function listar()
    {
        try {
            $negocios = $this->modelo->getListadoNegocios();
            if (!$negocios) {
                $data["error"] = "No se encontraron negocios.";
            } else {
                $data["negocios"] = $negocios;
            }
        } catch (Exception $e) {
            $data["error"] = "Error al obtener el listado de negocios: " . $e->getMessage();
        }
        
        $vista = new Vista();
        $vista->render("negocios", $data ?? []);
    }

    // Obtener negocio por ID
    public function detalle($id)
    {
        try {
            $negocio = $this->modelo->getNegocioPorId($id);
            if (!$negocio) {
                $data["error"] = "Negocio no encontrado.";
            } else {
                $data["negocio"] = $negocio;
                $data["imagenes"] = $this->modelo->getImagenesNegocio($id);
                $data["imagen_principal"] = $this->modelo->getImagenPrincipalNegocio($id);
            }
        } catch (Exception $e) {
            $data["error"] = "Error al obtener el detalle del negocio: " . $e->getMessage();
        }

        $vista = new Vista();
        $vista->render("detalle_negocio", $data ?? []);
    }

    // Obtener negocios por tipo
    public function listarPorTipo($tipo)
    {
        try {
            $negocios = $this->modelo->getListadoTipoNegocio($tipo);
            if (!$negocios) {
                $data["error"] = "No se encontraron negocios de este tipo.";
            } else {
                $data["negocios"] = $negocios;
                $data["tipo"] = $tipo;
            }
        } catch (Exception $e) {
            $data["error"] = "Error al obtener negocios por tipo: " . $e->getMessage();
        }

        $vista = new Vista();
        $vista->render("negocios_tipo", $data ?? []);
    }

    // Obtener negocios recomendados
    public function recomendados()
    {
        try {
            $negocios = $this->modelo->getNegocioRecomendado();
            if (!$negocios) {
                $data["error"] = "No hay negocios recomendados en este momento.";
            } else {
                $data["negocios"] = $negocios;
            }
        } catch (Exception $e) {
            $data["error"] = "Error al obtener negocios recomendados: " . $e->getMessage();
        }

        $vista = new Vista();
        $vista->render("negocios_recomendados", $data ?? []);
    }
}

?>