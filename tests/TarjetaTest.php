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


    public function testFranquiciaMedia(){
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaMedio = new FranquiciaMedia();
        $tarjetaMedio2 = new FranquiciaMedia();
        $tiempo = new Tiempo();
       
        $tiempo->avanzar(1440);
        $tarjetaMedio->recargar(100);
        
        $tiempo->avanzar(10);
        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 100-7.5);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 92.5-7.5);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 85-7.5);  

        $tiempo->avanzar(2);
        $colectivo->pagarCon($tarjetaMedio, $tiempo);
        $this->assertEquals($tarjetaMedio->obtenerSaldo(), 77.5-15);                
    }

    public function testFranquiciaTotal(){
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaGratis = new Franquicia();
        $tiempo = new Tiempo();
        $tiempo->avanzar(1440);
        $tarjetaGratis->recargar(100);

        $colectivo->pagarCon($tarjetaGratis, $tiempo);
        $this->assertEquals($tarjetaGratis->obtenerSaldo(), 100);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaGratis, $tiempo);
        $this->assertEquals($tarjetaGratis->obtenerSaldo(), 100);

        $tiempo->avanzar(10);

        $colectivo->pagarCon($tarjetaGratis, $tiempo);
        $this->assertEquals($tarjetaGratis->obtenerSaldo(), 100-15);
    }
}

