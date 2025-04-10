<?php
class Vista
{
    /* Renderizado */
    public function __construct(Type $var = null) {
        $this->var = $var;
    }
    
    public function render($vista, $data = [])
    {
        // Obtener la ruta de los ficheros css y js
        require_once __DIR__ . '/../config/Enrutador.php';
        $enrutador = new Enrutador();
        $ruta = $enrutador->getRuta();
        
        // Extraer variables para que estén disponibles en la vista
        extract($data);
        
        if (file_exists("./vistas/".$vista.".php"))
        {
            include_once "./vistas/".$vista.".php";
        }
    }
}
?>