<?php

use PHPUnit\Framework\TestCase;

require_once './modelo/InicioModelo.php';

class iniModeTest extends TestCase
{
    public function testgetvalidarUsuario(): void
    {
        $inicioModelo = new InicioModelo();

        // Simula los parámetros de entrada
        $email = 'test@test.com';
        $password = 'contrasena1234';

        // Llama al método a probar
        $resultado = $inicioModelo->getvalidarUsuario($email, $password);

        // Realiza las aserciones necesarias
        $this->assertFalse($resultado); // Cambia según el caso esperado
    }
}
?>