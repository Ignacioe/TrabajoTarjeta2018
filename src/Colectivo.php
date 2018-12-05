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
        
        $fecha_actual = $tiempo->tiempoactual;
        $multiplicador = 1;
        $ultimo_boleto = $tarjeta->ObtenerUltBol();

        if($tarjeta->obtenerTipo() == "Medio"){
            if($ultimo_boleto!=NULL){
                if($fecha_actual - $ultimo_boleto->obtenerFecha() > 4){
                    $multiplicador = 0.5;
                }
            } else {
                $multiplicador = 0.5;
            }
        }
        if($tarjeta->obtenerTipo() == "Gratis"){
            if($tiempo->dia!=$tarjeta->fechaViaje1){
                $tarjeta->fechaViaje1=$tiempo->dia;
                $multiplicador = 0;
            } elseif ($tiempo->dia!=$tarjeta->fechaViaje2){
                $tarjeta->fechaViaje2=$tiempo->dia;
                $multiplicador = 0;
            }
        }

        $precio_efectivo = $tarjeta->obtenerMonto() * $multiplicador;
        
        if($tarjeta->obtenerPlus2() == FALSE && $tarjeta->obtenerSaldo() >= $precio_efectivo+($tarjeta->obtenerMonto()*2)){
            $tarjeta->restarSaldo($precio_efectivo);
            $normaloplus="Normal";
            $pago="Abona 2 Viajes Plus";
            $mult=3;
        }
        else{
            if($tarjeta->obtenerPlus1() == FALSE ){
                if ($tarjeta->obtenerSaldo() >= ($precio_efectivo+$tarjeta->obtenerMonto())){
                    $tarjeta->restarSaldo($precio_efectivo);
                    $normaloplus="Normal";
                    $pago="Abona 1 viaje plus";
                    $mult=2;
                }
                else{
                    if($tarjeta->obtenerPlus2() == FALSE){
                        return FALSE;
                    }
                $tarjeta->CambiarPlus(2);               //Si no tengo credito y ya use el plus1, puedo usar el plus2
                $normaloplus="Viaje Plus";
                $pago="";
                $mult=0;
                }
            }
            else{
                if($tarjeta->obtenerSaldo() >= $precio_efectivo){
                    $tarjeta->restarSaldo($precio_efectivo);
                    $normaloplus="Normal";
                    $pago="";
                    $mult=1;
                }
                else{
                    $tarjeta->CambiarPlus(1);
                    $normaloplus="Viaje Plus";
                    $pago="";
                    $mult=0;
                }
            }
        }
        $boleto= new Boleto($precio_efectivo,$this,$tarjeta,$precio_efectivo*$mult,$normaloplus,$pago,$fecha_actual);
        $tarjeta->CambiarUltBol($boleto);
        return $boleto;
    }
}
?>