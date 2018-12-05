<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TiempoTest extends TestCase {

    public function testTiempo(){
        $tiempo= new Tiempo();
        $tiempo->avanzar(59);
        $this->assertEquals($tiempo->minutos,59);
        $this->assertEquals($tiempo->hora,0);
        $this->assertEquals($tiempo->dia,1);
        $tiempo->avanzar(1);
        $this->assertEquals($tiempo->minutos,0);
        $this->assertEquals($tiempo->hora,1);
        $this->assertEquals($tiempo->dia,1);
        $tiempo->avanzar(60);
        $this->assertEquals($tiempo->minutos,0);
        $this->assertEquals($tiempo->hora,2);
        $this->assertEquals($tiempo->dia,1);
        $tiempo->avanzar(1);
        $this->assertEquals($tiempo->minutos,1);
        $this->assertEquals($tiempo->hora,2);
        $this->assertEquals($tiempo->dia,1);
        $tiempo->avanzar(1319);
        $this->assertEquals($tiempo->minutos,0);
        $this->assertEquals($tiempo->hora,0);
        $this->assertEquals($tiempo->dia,2);
    }
}