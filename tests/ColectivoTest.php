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
    	$tarjetaNormal = new Tarjeta();
        $tiempo = new Tiempo();
        
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaNormal, $tiempo), FALSE);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaNormal, $tiempo), FALSE);
        $this->assertFalse($colectivo->pagarCon($tarjetaNormal, $tiempo));

        $tarjetaNormal->recargar(50);
    	$this->assertNotEquals( $colectivo->pagarCon($tarjetaNormal, $tiempo), FALSE);

    }

    public function testViajePlus() {
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaNormal = new Tarjeta();
        $tiempo = new Tiempo();

        $tarjetaNormal->recargar(10);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaNormal, $tiempo), FALSE);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaNormal, $tiempo), FALSE);
        $this->assertFalse($colectivo->pagarCon($tarjetaNormal, $tiempo));
        
        $tarjetaNormal2 = new Tarjeta();
        $tarjetaNormal2->recargar(10);
        $colectivo->pagarCon($tarjetaNormal2, $tiempo);

        $tarjetaNormal2->recargar(20);
        $colectivo->pagarCon($tarjetaNormal2, $tiempo);
        $this->assertEquals($tarjetaNormal2->obtenerSaldo(), 0.4);
    }

    public function testFranquiciaMedia(){
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaMedio = new FranquiciaMedia();
        $tiempo = new Tiempo();

        $tarjetaMedio->recargar(100);

        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 100-7.4);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 92.6-7.4);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 85.2-7.4);  

        $tiempo->avanzar(2);
        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 77.8-14.8);                
    }

}