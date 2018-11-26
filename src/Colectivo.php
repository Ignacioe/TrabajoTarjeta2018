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

    public function pagarCon(TarjetaInterface $tarjeta, TiempoInterface $tiempo){
        
        $fecha_actual = $tiempo->time();
        $multiplicador = 1;
        if($tarjeta->obtenerTipo() == "Medio"){
                $ultimo_boleto = $tarjeta->ObtenerUltBol();

                if ($ultimo_boleto == NULL){
                    $multiplicador=1;
                }

                if($fecha_actual - $ultimo_boleto->obtenerFecha() < 300){

                    $multiplicador = 2;

                }
                else{
                    
                    $multiplicador = 1;
                }
                
            }

        $precio_efectivo = $tarjeta->obtenerMonto() * $multiplicador;
    	
        if($tarjeta->obtenerPlus2() == FALSE && $tarjeta->obtenerSaldo() >= ($precio_efectivo*3)){
            $tarjeta->restarSaldo();
            $boleto= new Boleto($precio_efectivo,$this,$tarjeta,$precio_efectivo*3,"Normal","Abona 2 viajes plus",$fecha_actual);
            $tarjeta->CambiarUltBol($boleto);
            return $boleto;
        }
        else{
            if($tarjeta->obtenerPlus1() == FALSE ){
                if ($tarjeta->obtenerSaldo() >= ($precio_efectivo*2)){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($precio_efectivo,$this,$tarjeta,$precio_efectivo*2,"Normal","Abona 1 viaje plus",$fecha_actual);
                    $tarjeta->CambiarUltBol($boleto);
                    return $boleto;
                }
                else{
                    if($tarjeta->obtenerPlus2() == FALSE){
                        return FALSE;
                    }
                    $tarjeta->CambiarPlus(2);               //Si no tengo credito y ya use el plus1, puedo usar el plus2
                    $boleto= new Boleto($precio_efectivo,$this,$tarjeta,0.0,"Viaje Plus","",$fecha_actual);
                    $tarjeta->CambiarUltBol($boleto);
                    return $boleto;
                }
            }
            else{
                if($tarjeta->obtenerSaldo() >= $precio_efectivo){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($precio_efectivo,$this,$tarjeta,$precio_efectivo,"Normal","",$fecha_actual);
                    $tarjeta->CambiarUltBol($boleto);
                    return $boleto;
                }
                else{
                    $tarjeta->CambiarPlus(1);
                    $boleto= new Boleto($precio_efectivo,$this,$tarjeta,0.0,"Viaje Plus","",$fecha_actual);
                    $tarjeta->CambiarUltBol($boleto);
                    return $boleto;  
                }
            }
        }
    }
}
?>