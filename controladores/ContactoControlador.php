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
            $nombre = $_POST['firstName'] . ' ' . $_POST['lastName'];
            $email = $_POST['email'];
            $mensaje = $_POST['message'];

            if (empty($nombre) || empty($email) || empty($mensaje)) {
                $data["errorvalidacion"] = "Por favor, complete todos los campos del formulario.";
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("contacto", $data);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data["errorvalidacion"] = "Por favor, ingrese un correo electrónico válido.";
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("contacto", $data);
                return;
            }

            // Procesar el mensaje
            require_once("./modelo/ContactoModelo.php");
            $modelo = new ContactoModelo();
            
            // Intentar guardar en la base de datos
            $guardado = $modelo->guardarMensaje($nombre, $email, $mensaje);
            
            // Intentar enviar el email
            $enviado = $modelo->enviarEmail($nombre, $email, $mensaje);
            
            if ($guardado && $enviado) {
                $data["mensaje"] = "¡Gracias por contactarnos! Nos pondremos en contacto contigo pronto.";
                $data["tipo"] = "success";
            } else {
                if (!$guardado) {
                    $data["mensaje"] = "Hubo un problema al guardar tu mensaje. Por favor, intenta nuevamente.";
                } else {
                    $data["mensaje"] = "Tu mensaje ha sido recibido, pero hubo un problema al enviar la confirmación por email.";
                }
                $data["tipo"] = "warning";
            }
            
            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("procesar_contacto", $data);
        } else {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: ".$route->getRuta()."contacto/mostrarFormulario");
            exit();
        }
    }
}
?>
