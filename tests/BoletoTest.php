<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $tarjetaGratis = new Franquicia();
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);

        $boleto = new Boleto($valor,$colectivo, $tarjetaGratis,NULL,NULL,NULL,0);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }

    public function testTipoBoleto(){
        $valor = 14.80;
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaJose = new Tarjeta();
        $boleto = new Boleto($valor,$colectivo, $tarjetaJose,NULL,NULL,NULL,0);
        $tiempo = new Tiempo();
        $tiempo->avanzar(1440);
        $tarjetaJose->recargar(20);
        
        $boleto= $colectivo->pagarCon($tarjetaJose,$tiempo);
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Normal");
        
        $tiempo->avanzar(10);
        $boleto= $colectivo->pagarCon($tarjetaJose,$tiempo);
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Viaje Plus");
        
        $tiempo->avanzar(10);
        $boleto= $colectivo->pagarCon($tarjetaJose,$tiempo);
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Viaje Plus");
        
    }

    public function testObtenerColectivo(){
        $valor = 14.80;
        $tarjetaJose = new Tarjeta();
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $boleto = new Boleto($valor,$colectivo, $tarjetaJose,NULL,NULL,NULL,0);

        $this->assertequals($boleto->obtenerColectivo(),"142 Rojo");
    }
}
