<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
    protected $ID;

    public function __construct(){
      $this->saldo=0.0;
      $this->ID=1;
    }

    public function recargar($monto) {
        
        if($monto==10 || $monto==20 || $monto==30 || $monto==50 || $monto==100){
          $this->saldo += $monto;
        }
        if($monto==510.15){
          $this->saldo += $monto;
          $this->saldo += 81.93;
        }
        if($monto==962.59){
          $this->saldo += $monto;
          $this->saldo += 221.58;
        }

      //Esta parte no va, porque esta funcion es solo de recarga. Si quisieramos retornar el saldo, habria que hacer otra funcion.
      //return $monto % 2 == 0;
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
