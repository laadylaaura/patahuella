<?php

use PHPUnit\Framework\TestCase;

require_once './modelo/ContactoModelo.php';

class conModeTest extends TestCase
{

    public function testguardarMensaje(): void
    {
$ContactoModelo = new ContactoModelo();
        // Simula los parámetros de entrada
$nombre = 'Cristofer';
$apellido = 'Gonzalez';
$email = 'cristofer@gmail.com';
$mensaje = 'Hola, soy Cristofer.';


        // Llama al método a probar
        $resultado = $ContactoModelo->guardarMensaje($nombre, $apellido, $email, $mensaje);

        // Realiza las aserciones necesarias
        $this->assertTrue($resultado > 0, 'El ID del mensaje insertado debería ser mayor que 0'); // Cambia según el caso esperado

        // Imprime el resultado para verificarlo
        echo "Resultado de guardarMensaje: ";
        echo "Nombre: " . $nombre . ", Apellido: " . $apellido . ", Email: " . $email . ", Mensaje: " .
$mensaje;

    }
}