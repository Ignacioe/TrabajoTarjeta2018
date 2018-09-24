<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testNombre() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
    	$this->assertEquals($colectivo->linea(), "142 Rojo");
    }

    public function testPagarCon() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
    	$tarjetaJose = new Tarjeta();
    	$this->assertFalse($colectivo->pagarCon($tarjetaJose));

    	$tarjetaJose->recargar(50);
    	$this->assertEquals( ( ($colectivo->pagarCon($tarjetaJose) )->obtenerColectivo() )->linea() , $colectivo->linea() );
    }
}
