<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
    protected $ID;
    protected $viajesPlus1;
	protected $viajesPlus2;
	protected $monto;

    public function __construct(){
      $this->saldo=0.0;
      $this->ID=rand();
      $this->viajesPlus1=TRUE;
	  $this->viajesPlus2=TRUE;
	  $this->monto = 14.80;
    }

    public function recargar($monto) {
        if($monto==10 || $monto==20 || $monto==30 || $monto==50 || $monto==100 || $monto==510.15 || $monto==962.59 ){
			if($monto==510.15){
				$this->saldo += $monto;
				$this->saldo += 81.93;
				return TRUE;
		  	}
	  
		 	if($monto==962.59){
				$this->saldo += $monto;
				$this->saldo += 221.58;
				return TRUE;
		  }

		  $this->saldo += $monto;
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

	public function obtenerPlus1 (){
		return $this->viajesPlus1;
	}
	public function obtenerPlus2 (){
		return $this->viajesPlus2;
	}
    public function CambiarPlus($op){
    	if($op==1){
    		$this->viajesPlus1=FALSE;
    	}
    	else{
    		$this->viajesPlus2 =FALSE;
    	}
	}
	
	public function obtenerMonto (){
		return $this->monto;
	}

    public function restarSaldo() {
    
 		if ($this->viajesPlus2==FALSE){ 	//Si viaje plus2 es false, tengo que pagar 2 plus y un boleto.
				$this->viajesPlus1=TRUE;	//Cambio los plus a true
				$this->viajePlus2 = TRUE;
 				$this->saldo -= ($this->obtenerMonto()*3); 	//le resto al saldo los 3 boletos
 				return;
 		}
 		else{
			 
			if($this->viajesPlus1 == FALSE ){	//Si solo tengo que pagar 1 plus
 				$this->viajesPlus1 = TRUE;
 				$this->saldo -= ($this->obtenerMonto()*2);			//Resto el plus y 1 boleto
 				return;
 			}
 				else{
					$this->saldo -= $this->obtenerMonto();	
 					return;
				}
 		}
	}
}


