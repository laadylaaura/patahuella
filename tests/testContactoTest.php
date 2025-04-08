<?php

use PHPUnit\Framework\TestCase;

require_once './modelo/ContactoModelo.php';
require_once './lib/GestorBD.php';

class testContactoModelo extends TestCase
{
    private $contactoModelo; // Instancia de ContactoModelo
    private $mockGestorBD;   // Mock de GestorBD

    protected function setUp(): void
    {
        // Crear una instancia de ContactoModelo
        $this->contactoModelo = $this->getMockBuilder(ContactoModelo::class)
            ->onlyMethods(['getGestorBDInstance'])
            ->getMock();

        // Crear un Mock para la clase GestorBD
        $this->mockGestorBD = $this->createMock(GestorBD::class);

        // Configurar el método getGestorBDInstance para devolver el mock
        $this->contactoModelo->method('getGestorBDInstance')
            ->willReturn($this->mockGestorBD);
    }

    public function testGuardarMensajeExitoso()
    {
        // Configurar el Mock para devolver un resultado exitoso
        $this->mockGestorBD->method('consultaInsercion')
            ->willReturn(true);

        // Llamar al método y verificar el resultado
        $resultado = $this->contactoModelo->guardarMensaje(
            'Juan',
            'Pérez',
            'juan.perez@example.com',
            'Este es un mensaje de prueba'
        );

        $this->assertTrue($resultado);
    }

    public function testGuardarMensajeFallido()
    {
        // Configurar el Mock para devolver un resultado fallido
        $this->mockGestorBD->method('consultaInsercion')
            ->willReturn(false);

        // Llamar al método y verificar el resultado
        $resultado = $this->contactoModelo->guardarMensaje(
            'Ana',
            'Gómez',
            'ana.gomez@example.com',
            'Este es otro mensaje de prueba'
        );

        $this->assertFalse($resultado);
    }
}