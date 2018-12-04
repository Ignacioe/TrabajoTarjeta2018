<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testNombre() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $this->assertEquals($colectivo->linea(), "142 Rojo");
        $this->assertEquals($colectivo->empresa(), "Semtur");
        $this->assertEquals($colectivo->numero(), 10);
        $colectivo2 = new Colectivo("Alvarez", "Interbus", 420);
        $this->assertEquals($colectivo2->linea(), "Alvarez");
        $this->assertEquals($colectivo2->empresa(), "Interbus");
        $this->assertEquals($colectivo2->numero(), 420);
    }

    public function testPagarCon() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
    	$tarjetaJose = new Tarjeta();
        $tiempo = new Tiempo();
        
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertFalse($colectivo->pagarCon($tarjetaJose, $tiempo));

        $tarjetaJose->recargar(50);
    	$this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);

    }

    public function testViajePlus() {
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaJose = new Tarjeta();
        $tiempo = new Tiempo();

        $tarjetaJose->recargar(10);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertFalse($colectivo->pagarCon($tarjetaJose, $tiempo));
        
        $tarjetaJose2 = new Tarjeta();
        $tarjetaJose2->recargar(10);
        $colectivo->pagarCon($tarjetaJose2, $tiempo);

        $tarjetaJose2->recargar(20);
        $colectivo->pagarCon($tarjetaJose2, $tiempo);
        $this->assertEquals($tarjetaJose2->obtenerSaldo(), 0.4);
    }

    public function testFranquiciaMedia(){
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaJose = new FranquiciaMedia();
        $tiempo = new Tiempo();

        $tarjetaJose->recargar(100);

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 100-7.4);

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 92.6-7.4);

        $tiempo->tiempoactual+=360;

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 85.2-7.4);                
    }

}