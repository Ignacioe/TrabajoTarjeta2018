<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
    protected $ID;
    protected $viajesPlus1;
    protected $viajesPlus2;

    public function __construct(){
      $this->saldo=0.0;
      $this->ID=1;
      $this->viajesPlus1=0;
      $this->viajesPlus2=0;
    }

    public function recargar($monto) {
        if($monto==10 || $monto==20 || $monto==30 || $monto==50 || $monto==100 && ($monto-$viajesPlus1-$viajesPlus2>0)){
          $this->saldo += $monto-$viajesPlus1-$viajesPlus2;
          $this->viajesPlus1 = 0;
          $this->viajesPlus2 = 0;
          return TRUE;
        }
        if($monto==510.15){
          $this->saldo += $monto-$viajesPlus1-$viajesPlus2;
          $this->saldo += 81.93;
          $this->viajesPlus1 = 0;
          $this->viajesPlus2 = 0;
          return TRUE;
        }
        if($monto==962.59){
          $this->saldo += $monto-$viajesPlus1-$viajesPlus2;
          $this->saldo += 221.58;
          $this->viajesPlus1 = 0;
          $this->viajesPlus2 = 0;
          return TRUE;
        }

        return FALSE;
    }

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    
    public function obtenerSaldo() {
      return $this->saldo;
    }

    public function restarSaldo() {
      $this->saldo -= 14.80;
    }

}
