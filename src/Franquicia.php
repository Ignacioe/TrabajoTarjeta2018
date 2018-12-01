<?php
namespace TrabajoTarjeta;

class Franquicia extends Tarjeta {
    protected $monto = 0.0;

    public function __construct(){
        $this->saldo=0.0;
        $this->ID=rand();
        $this->viajesPlus1=TRUE;
        $this->viajesPlus2=TRUE;
        $this->Ult_boleto = NULL;
        $this->tipo = "Gratis";
    }
} 

?>