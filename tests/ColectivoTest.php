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
        $tiempo = new TiempoFalso();
        
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);
        $this->assertFalse($colectivo->pagarCon($tarjetaJose, $tiempo));

        $tarjetaJose->recargar(50);
    	$this->assertNotEquals( $colectivo->pagarCon($tarjetaJose, $tiempo), FALSE);

    }

    public function testViajePlus() {
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaJose = new Tarjeta();
        $tiempo = new TiempoFalso();

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
        $tiempo = new TiempoFalso();

        $tarjetaJose->recargar(100);

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 100-7.4);

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertNotEquals($tarjetaJose->ObtenerUltBol(), NULL);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 92.6-14.8);

        $time->Avanzar(360);

        $colectivo->pagarCon($tarjetaJose, $tiempo);

        $this->assertEquals($tarjetaJose->obtenerSaldo(), 77.8-7.4);                
    }

}