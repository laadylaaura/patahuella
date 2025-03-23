<?php

class UsuarioModelo
{
    public function __construct($var = null) {
        $this->var = $var;
    }
    public function getInsertarUsuario($nombre, $email, $contrasena)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();

        // Primero verificamos si el usuario ya existe
        $sqlVerificar = "SELECT COUNT(*) FROM Usuarios WHERE email = ?";
        $resultado = $gbd->consultaLectura($sqlVerificar, $email);

        // Si el usuario ya existe, retornamos false
        if ($resultado > 0) {
            return false;
        }

        // Si el usuario no existe, lo insertamos
        $sqlInsertar = "INSERT INTO Usuarios VALUES(?, ?, ?)";
        $resultado = $gbd->consultaInsercion($sqlInsertar, $nombre, $email, $contrasena);

        // Retornamos true si la inserción fue exitosa
        return ($resultado !== false);
    }
    
    public function getObtenerUsuarioPorId($id)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Usuarios WHERE id_usuario = ?";
        $resultado = $gbd->consultaLectura($consulta, $id);

        if(is_array($resultado) && count($resultado) > 0) {
            return $resultado[0];
        } else {
            return false;
        }
    }
   
    public function getRegistrarUsuario($nombre, $email, $contrasena)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();

        // Primero verificamos si el usuario ya existe
        $consultaVerificar = "SELECT COUNT(*) as contador FROM Usuarios WHERE email = ?";
        $resultado = $gbd->consultaLectura($consultaVerificar, $email);

        // Si el usuario ya existe, retornamos false
        if (is_array($resultado) && count($resultado) > 0 && $resultado[0]['contador'] > 0) {
            return [
                'exito' => false,
                'mensaje' => 'Este correo electrónico ya está registrado'
            ];
        }
        
        
        $consulta = "INSERT INTO Usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
        $resultado = $gbd->consultaInsercion($consulta, $nombre, $email, $contrasena);

        // Retornamos true si la inserción fue exitosa
        if ($resultado !== false) {
            return [
                'exito' => true,
                'mensaje' => 'Usuario registrado correctamente',
                'id_usuario' => $resultado
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'Error al registrar el usuario'
            ];
        }
    }

    public function getUpdateUsuario($id_usuario, $nombre, $email, $contrasena = null)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        
        // Si se va a actualizar la contraseña
        if ($contrasena !== null) {
            $consulta = "UPDATE Usuarios SET nombre = ?, email = ?, contrasena = ? WHERE id_usuario = ?";
            $resultado = $gbd->consultaUpdate($consulta, $nombre, $email, $contrasena, $id_usuario);
        } else {
            // Si solo se actualizan nombre y email
            $consulta = "UPDATE Usuarios SET nombre = ?, email = ? WHERE id_usuario = ?";
            $resultado = $gbd->consultaUpdate($consulta, $nombre, $email, $id_usuario);
        }
        
        return $resultado;
    }

    public function getValidarUsuario($email, $contrasena)
    {
        require_once("./lib/GestorBD.php");
        $gbd = new GestorBD();
        $consulta = "SELECT * FROM Usuarios WHERE email = ? AND contrasena = ?";
        $resultado = $gbd->consultaLectura($consulta, $email, $contrasena);

        if(is_array($resultado) && count($resultado) > 0) {
            return $resultado[0]['id_usuario'];
        }
        return false;
    }
}
?> 