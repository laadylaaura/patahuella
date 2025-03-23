<?php
class GestorBD
{
 private static $conn = null;


 // Constructor sin parámetros
 public function __construct()
 {
   // No necesitamos inicializar nada aquí
 }


 // Método para establecer conexión como un singleton
 public static function conectar()
 {
   if (self::$conn === null) {
     require_once './config/Configuracion.php';
     $conf = Configuracion::getInstance();
     $servidor = $conf->getServidorBD();
     $usuario = $conf->getUsuarioBD();
     $password = $conf->getPasswordBD();
     $nombre = $conf->getNombreBD();


     self::$conn = new mysqli($servidor, $usuario, $password, $nombre);


     if (self::$conn->connect_error != null) {
       die("Error en la conexión: " . self::$conn->connect_error);
     }
    
     self::$conn->set_charset('utf8');
   }
  
   return self::$conn;
 }


 // Método para preparar las consultas y sus parámetros
 public function preparar($consulta, ...$parametros) {
   $conexion = self::conectar();
   $preparacion = $conexion->prepare($consulta);
  
   if ($preparacion === false) {
     die("Error al preparar la consulta: " . $conexion->error);
   }
  
   if (!empty($parametros)) {
     $tipos = '';
     foreach ($parametros as $parametro) {
       $tipos .= is_int($parametro) ? 'i' : 's';
     }
     $preparacion->bind_param($tipos, ...$parametros);
   }
  
   return $preparacion;
 }


 // Método para realizar consultas de lectura (SELECT)
 public function consultaLectura($consulta, ...$parametros) {
   $preparacion = self::preparar($consulta, ...$parametros);
  
   if ($preparacion->execute()) {
     $resultado = $preparacion->get_result();
     if ($resultado->num_rows > 0) {
       return $resultado->fetch_all(MYSQLI_ASSOC);
     } else {
       return [];
     }
   } else {
     die("Error en la ejecución de la consulta: " . $preparacion->error);
   }
 }


 // Método para realizar consultas de inserción (INSERT)
 public function consultaInsercion($consulta, ...$parametros) {
   $preparacion = self::preparar($consulta, ...$parametros);
  
   if ($preparacion->execute()) {
     $id_insertado = self::$conn->insert_id;
     if ($id_insertado > 0) {
       return $id_insertado;
     }
     return true;
   } else {
     return false;
   }
 }

 public function consultaUpdate($consulta, ...$parametros) {
    $preparacion = self::preparar($consulta, ...$parametros);
    
    if ($preparacion->execute()) {
        // En un UPDATE lo importante es verificar filas afectadas
        $filasAfectadas = $preparacion->affected_rows;
        
        if ($filasAfectadas > 0) {
            // Se actualizó al menos un registro
            return true;
        } else {
            // La consulta se ejecutó pero no modificó ningún registro
            // (quizás el UPDATE no cambió valores o no encontró coincidencias)
            return true; // También retornamos true ya que la consulta fue exitosa
        }
    } else {
        // La consulta falló
        return false;
    }
 }

 // Método para realizar consultas de eliminación (DELETE)
 public  function consultaEliminar($consulta, ...$parametros) {
   $preparacion = self::preparar($consulta, ...$parametros);
   
   if ($preparacion->execute()) {
     $filasAfectadas = $preparacion->affected_rows;
     return $filasAfectadas > 0;
   } else {
     return false;
   }
 }


 // Método para cerrar la conexión
 public static function cerrarConexion() {
   if (self::$conn !== null) {
     self::$conn->close();
     self::$conn = null;
   }
 }
}
?>