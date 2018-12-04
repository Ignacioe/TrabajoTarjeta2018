<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    public function testCargaSaldo() {
        $tarjeta = new Tarjeta();

        $this->assertTrue($tarjeta->recargar(10));
        $this->assertEquals($tarjeta->obtenerSaldo(), 10);

        $this->assertTrue($tarjeta->recargar(20));
        $this->assertEquals($tarjeta->obtenerSaldo(), 30);

        $this->assertTrue($tarjeta->recargar(50));
        $this->assertEquals($tarjeta->obtenerSaldo(), 80);

        $this->assertTrue($tarjeta->recargar(100));
        $this->assertEquals($tarjeta->obtenerSaldo(), 180);

        $this->assertTrue($tarjeta->recargar(510.15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 772.08);

        $this->assertTrue($tarjeta->recargar(962.59));
        $this->assertEquals($tarjeta->obtenerSaldo(), 1956.25);

    }

    public function testCargaSaldoInvalido() {
      $tarjeta = new Tarjeta();

      $this->assertFalse($tarjeta->recargar(15));
      $this->assertEquals($tarjeta->obtenerSaldo(), 0);
    }


    public function testFranquicia(){
        $tarjetaGratis = new Franquicia();
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tiempo = new Tiempo();

        for($i=0; $i < 4; $i++){
            $this->assertNotEquals($colectivo->pagarCon($tarjetaGratis, $tiempo),FALSE);
        }


    }

    public function testFranquiciaMedia() {
        $tarjetaMedia = new FranquiciaMedia();
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tiempo = new Tiempo();
                
        $tarjetaMedia->recargar(10);
        
        $colectivo->pagarCon($tarjetaMedia, $tiempo);

        $this->assertEquals($tarjetaMedia->obtenerSaldo(), 2.60);
    }
}

