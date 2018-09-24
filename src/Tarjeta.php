<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
    protected $ID;
    protected $viajesPlus1;
    protected $viajesPlus1;

    public function __construct(){
      $this->saldo=0.0;
      $this->ID=rand();
      $this->viajesPlus1=TRUE;
      $this->viajesPlus2=TRUE;
    }

    public function recargar($monto) {
        if($monto==10 || $monto==20 || $monto==30 || $monto==50 || $monto==100){
          	if($this->viajesPlus1 == FALSE && $this->viajesPlus2 ==FALSE){
          		$monto -= 29.60;
          		if($monto < 0){
          			return FALSE;
          		}
          		else{
          			$this->saldo += $monto;
          			$this->viajesPlus1 = TRUE;
          			$this->viajesPlus2 = TRUE;
          		}
          		return TRUE;
      		}
     
      		
     	 	if($this->viajesPlus1 == FALSE && $this->viajesPlus2 ==TRUE){
      			$monto -= 14.80;
      			if($monto < 0){
          			return FALSE;
          		}
          		else{
          			$this->saldo += $monto;
          			$this->viajesPlus1 = TRUE;
          			$this->viajesPlus2 = TRUE;
          		}

          		return TRUE;
      		}

      		if($this->viajesPlus1 == TRUE && $this->viajesPlus2 ==TRUE){
      			$this->saldo += $monto;
          		return TRUE;
      		}
 		}

        if($monto==510.15){
        	if($this->viajesPlus1 == FALSE && $this->viajesPlus2 ==FALSE){
          		$this->saldo += $monto;
          		$this->saldo += 81.93;
          		$this->saldo -= 29.60;
          		$this->viajesPlus1 = TRUE;
          		$this->viajesPlus2 = TRUE;
          		return TRUE;
      		}

      		if($this->viajesPlus1 == FALSE && $this->viajesPlus2 ==TRUE){
      			$this->saldo += $monto;
          		$this->saldo += 81.93;
          		$this->saldo -= 14.80;
          		$this->viajesPlus1 = TRUE;
          		return TRUE;
      		}

      		if($this->viajesPlus1 == TRUE && $this->viajesPlus2 ==TRUE){
      			$this->saldo += $monto;
          		$this->saldo += 81.93;
          		return TRUE;
      		}
        }
        if($monto==962.59){
          $this->saldo += $monto;
          $this->saldo += 221.58;
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

    public function CambiarPlus($op){
    	if($op==1){
    		$this->viajesPlus1=FALSE;
    	}
    	else{
    		$this->viajesPlus2 =FALSE;
    	}
    }

    public function restarSaldo() {
    	if ($this->saldo >= 14.80){		//si tengo saldo descuento normal
      		$this->saldo -= 14.80;
      		return;
 		}
 		else{
 			if ($this->viajesPlus1==TRUE){ 	//Si no tengo saldo chequeo si es mi primer viaje plus o el segundo
 				$this->viajesPlus1=FALSE;	//si es el primero lo pongo en falso
 				$this->saldo -= 14.80; 	//le resto al saldo 14,80
 				return;
 			}
 			else{
 				if($this->viajesPlus2 == TRUE){
 				$this->viajesPlus2 = FALSE;
 				$this->saldo -= 14.80;
 				return;
 				}
 				else{
 					return;
				}
 			}
 		}

	}
}

