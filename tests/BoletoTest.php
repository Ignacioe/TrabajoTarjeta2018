<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $tarjetaGratis = new Franquicia();
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);

        $boleto = new Boleto($valor,$colectivo, $tarjetaGratis,NULL,NULL);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
}
