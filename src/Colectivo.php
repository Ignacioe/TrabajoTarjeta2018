<?php 

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea;

    protected $empresa;

    protected $numero;

    public function __construct($linea, $empresa, $numero) {
        $this->linea = $linea;
        $this->empresa = $empresa;
        $this->numero = $numero;
    }

    public function linea(){
    	return $this->linea;
    }

    public function empresa(){
    	return $this->empresa;
    }

    public function numero(){
    	return $this->numero;
    }

    public function pagarCon(TarjetaInterface $tarjeta){
    	if($tarjeta->obtenerPlus2() == FALSE && $tarjeta->obtenerSaldo() >= ($tarjeta->obtenerMonto()*3)){
            $tarjeta->restarSaldo();
            $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta,$tarjeta->obtenerMonto()*3,"Normal");
            return $boleto;
        }
        else{
            if($tarjeta->obtenerPlus1() == FALSE ){
                if ($tarjeta->obtenerSaldo() >= ($tarjeta->obtenerMonto()*2)){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta,$tarjeta->obtenerMonto()*2,"Normal");
                    return $boleto;
                }
                else{
                    if($tarjeta->obtenerPlus2() == FALSE){
                        return FALSE;
                    }
                    $tarjeta->CambiarPlus(2);               //Si no tengo credito y ya use el plus1, puedo usar el plus2
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta,0.0,"Viaje Plus");
                    return $boleto;
                }
            }
            else{
                if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerMonto()){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta,$tarjeta->obtenerMonto(),"Normal");
                    return $boleto;
                }
                else{
                    $tarjeta->CambiarPlus(1);
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta,0.0,"Viaje Plus");
                    return $boleto;  
                }
            }
        }
    }
}
?>