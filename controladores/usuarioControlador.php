<?php
class UsuarioControlador
{

    public function __construct(Type $var = null)
    {
        $this->var = $var;
    }

    public function listarMiPerfil()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();

        if ($ses->existeSesion("CLAVE")) {
            $usuarioId = $ses->obtenerValorDeSesion("CLAVE");

            // Obtener datos del usuario desde la BD
            require_once("./modelo/UsuarioModelo.php");
            $modelo = new UsuarioModelo();
            $datosUsuario = $modelo->getObtenerUsuarioPorId($usuarioId);

            // Obtener mensajes de la URL si existen
            $mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : null;
            $error = isset($_GET['error']) ? $_GET['error'] : null;

            // Preparar mensajes para la vista
            $mensajes = [];
            if ($mensaje) {
                switch ($mensaje) {
                    case 'agregado':
                        $mensajes['exito'] = 'Negocio agregado a favoritos correctamente';
                        break;
                    case 'eliminado':
                        $mensajes['exito'] = 'Negocio eliminado de favoritos correctamente';
                        break;
                    case 'actualizado':
                        $mensajes['exito'] = 'Perfil actualizado correctamente';
                        break;
                }
            }
            if ($error) {
                switch ($error) {
                    case 'ya_existe':
                        $mensajes['error'] = 'Este negocio ya está en tus favoritos';
                        break;
                    case 'agregar':
                        $mensajes['error'] = 'Error al agregar el negocio a favoritos';
                        break;
                    case 'eliminacion':
                        $mensajes['error'] = 'Error al eliminar el negocio de favoritos';
                        break;
                    case 'actualizacion':
                        $mensajes['error'] = 'Error al actualizar el perfil';
                        break;
                    case 'usuario_no_encontrado':
                        $mensajes['error'] = 'Usuario no encontrado';
                        break;
                }
            }

            require_once("./vistas/Vista.php");
            $vista = new Vista();
            $vista->render("mi_perfil", [
                "usuario" => $datosUsuario,
                "mensajes" => $mensajes
            ]);
        } else {
            // No hay sesión, redireccionar a login
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: " . $route->getRuta() . "inicio/sesionLogin");
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
            header("Location: " . $route->getRuta() . "inicio/sesionLogin");
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
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?mensaje=actualizado");
            } else {
                // Redirigir al perfil con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?error=actualizacion");
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
            header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?error=usuario_no_encontrado");
            exit();
        }

        // Mostrar el formulario de edición
        require_once("./vistas/Vista.php");
        $vista = new Vista();
        $vista->render("editar_perfil", ["usuario" => $usuario]);
    }

    public function registro()
    {
        // Mostrar formulario de registro
        require_once("./vistas/Vista.php");
        $vista = new Vista();
        $vista->render("registro", []);
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar datos de entrada
            $errores = [];

            // Recoger los datos del formulario
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');
            $confirmar_contrasena = trim($_POST['confirmar_contrasena'] ?? '');

            // Realizar validaciones
            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio";
            }

            if (empty($email)) {
                $errores[] = "El correo electrónico es obligatorio";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El formato del correo electrónico no es válido";
            }

            if (empty($contrasena)) {
                $errores[] = "La contraseña es obligatoria";
            } elseif (strlen($contrasena) < 6) {
                $errores[] = "La contraseña debe tener al menos 6 caracteres";
            }

            if ($contrasena !== $confirmar_contrasena) {
                $errores[] = "Las contraseñas no coinciden";
            }

            // Si hay errores, volver al formulario con los mensajes
            if (!empty($errores)) {
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("registro", [
                    'errores' => $errores,
                    'nombre' => $nombre,
                    'email' => $email
                ]);
                return;
            }

            // Si no hay errores, proceder con el registro
            require_once("./modelo/UsuarioModelo.php");
            $modelo = new UsuarioModelo();
            $resultado = $modelo->registrarUsuario($nombre, $email, $contrasena);

            if ($resultado['exito']) {
                // Redirigir a login con mensaje de éxito
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "inicio/sesionLogin?registro=exito");
                exit();
            } else {
                // Volver al formulario con mensaje de error del modelo
                require_once("./vistas/Vista.php");
                $vista = new Vista();
                $vista->render("registro", [
                    'errores' => [$resultado['mensaje']],
                    'nombre' => $nombre,
                    'email' => $email
                ]);
                return;
            }
        } else {
            // Si no es una petición POST, mostrar el formulario
            $this->registro();
        }
    }

    public function eliminarFavorito()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();

        if (!$ses->existeSesion("CLAVE")) {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: " . $route->getRuta() . "inicio/sesionLogin");
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
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?mensaje=eliminado");
            } else {
                // Redirigir de vuelta al perfil con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?error=eliminacion");
            }
        } else {
            // Si no hay parámetros, redirigir al perfil
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: " . $route->getRuta() . "usuario/listarMiPerfil");
        }
        exit();
    }

    public function agregarFavorito()
    {
        require_once("./lib/GestorSesiones.php");
        $ses = new GestorSesiones();

        if (!$ses->existeSesion("CLAVE")) {
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: " . $route->getRuta() . "inicio/sesionLogin");
            exit();
        }

        if (isset($_GET['id']) && isset($_GET['tipo'])) {
            $id_negocio = $_GET['id'];
            $tipo = $_GET['tipo'];
            $usuarioId = $ses->obtenerValorDeSesion("CLAVE");

            require_once("./modelo/FavoritosModelo.php");
            $modeloFavoritos = new FavoritoModelo();

            // Verificar si ya existe el favorito
            if ($modeloFavoritos->getComprobarFavoritoExiste($usuarioId, $id_negocio)) {
                // Si ya existe, redirigir con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?error=ya_existe");
                exit();
            }

            // Intentar agregar el favorito
            if ($modeloFavoritos->getAnadirFavoritos($usuarioId, $id_negocio)) {
                // Redirigir de vuelta al perfil con mensaje de éxito
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?mensaje=agregado");
            } else {
                // Redirigir de vuelta al perfil con mensaje de error
                require_once("./config/Enrutador.php");
                $route = new Enrutador();
                header("Location: " . $route->getRuta() . "usuario/listarMiPerfil?error=agregar");
            }
        } else {
            // Si no hay parámetros, redirigir al perfil
            require_once("./config/Enrutador.php");
            $route = new Enrutador();
            header("Location: " . $route->getRuta() . "usuario/listarMiPerfil");
        }
        exit();
    }
}
?>