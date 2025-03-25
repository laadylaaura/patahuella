<?php
class ContactoControlador {
    public function __construct(Type $var = null) {
        $this->var = $var;
    }

    public function mostrarFormulario()
    {
        require_once('./lib/GestorSesiones.php');
        $ses = new GestorSesiones();
        
        if($ses->existeSesion("CLAVE")){
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("contacto", []);
        } else {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."inicio/sesionLogin");
            exit();
        }
    }

    public function procesarContacto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtenemos los datos del formulario
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

            // Validamos que todos los campos estén completos
            if (empty($nombre) || empty($apellido) || empty($email) || empty($mensaje)) {
                $data["errorvalidacion"] = "Por favor, complete todos los campos del formulario.";
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("contacto", $data);
                return;
            }

            // Validamos el formato del email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data["errorvalidacion"] = "Por favor, ingrese un correo electrónico válido.";
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("contacto", $data);
                return;
            }

            // Guardamos el mensaje en la base de datos
            require_once("./modelo/ContactoModelo.php");
            $modelo = new ContactoModelo();
            
            $guardado = $modelo->guardarMensaje($nombre, $apellido, $email, $mensaje);
            
        
            if ($guardado) {
                $data["mensaje"] = "¡Gracias por contactarnos! Hemos recibido tu mensaje y nos pondremos en contacto contigo pronto.";
                $data["tipo"] = "success";
            } else {
                $data["mensaje"] = "Hubo un problema al guardar tu mensaje. Por favor, intenta nuevamente.";
                $data["tipo"] = "danger";
            }
            
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("contacto", $data);
        } else {
            // Si no es una petición POST, redirigimos al formulario
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."contacto/mostrarFormulario");
            exit();
        }
    }
}
?>
