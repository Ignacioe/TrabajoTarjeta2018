<?php
namespace TrabajoTarjeta;

class FranquiciaMedia extends Tarjeta {
    protected $monto = 15;

    public function __construct() {
        $this->saldo = 0.0;
        $this->ID = rand();
        $this->viajesPlus1 = true;
        $this->viajesPlus2 = true;
        $this->Ult_boleto = true;
        $this->tipo = "Medio";
        $this->primerViaje = true;
    }
} 
