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

    public function TestTipoBoleto(){
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $boleto = new Boleto($valor,$colectivo, $tarjetaGratis,NULL,NULL,NULL,0);
        $tarjetaJose = new Tarjeta();
        
        $tarjetaJose->recargar(20);
        
        $boleto= $colectivo->pagarCon($tarjetaJose);
        
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Normal");
       
        $boleto= $colectivo->pagarCon($tarjetaJose);
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Viaje Plus");
        
        $boleto= $colectivo->pagarCon($tarjetaJose);
        $this->assertEquals($boleto->obtenerTipoBoleto(),"Viaje Plus");
        
    }
}
