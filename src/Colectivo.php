<?php 

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea;
    protected $empresa;
    protected $numero;

    public function __construct($linea, $empresa, $numero) {
        $this->linea=$linea;
        $this->empresa=$empresa;
        $this->numero=$numero;
    }

    public function linea() {
        return $this->linea;
    }

    public function empresa() {
        return $this->empresa;
    }

    public function numero() {
        return $this->numero;
    }

    public function pagarCon(TarjetaInterface $tarjeta, TiempoInterface $tiempo) {
        
        $fecha_actual=$tiempo->tiempoactual;
        $multiplicador=1;
        $ultimo_boleto=$tarjeta->ObtenerUltBol();
        if($ultimo_boleto!=NULL){
            if ($tarjeta->obtenerTipo()=="Medio") {
                $multiplicador=$this->pagarConMedio($tarjeta,$tiempo,$ultimo_boleto,$fecha_actual);
                
            }
            if ($tarjeta->obtenerTipo()=="Gratis") {
                $multiplicador=$this->pagarConFranquiciaTotal($tarjeta,$tiempo);
            }
        } else {
            if ($tarjeta->obtenerTipo()=="Medio") {
                $multiplicador=0.5;
            }
            if ($tarjeta->obtenerTipo()=="Gratis") {
                $multiplicador=0;
            }
        }
        $multiplicador*=$this->esTrasbordo($tarjeta, $tiempo);
        $precio_efectivo=$tarjeta->obtenerMonto()*$multiplicador;
        
        if ($this->puedePagarDosPlus($tarjeta,$tiempo,$precio_efectivo)) {
            $tarjeta->restarSaldo($precio_efectivo);
            $normaloplus="Normal";
            $pago="Abona 2 Viajes Plus";
            $mult=3;
        } else {
            if ($tarjeta->obtenerPlus1()===FALSE) {
                if ($tarjeta->obtenerSaldo()>=($precio_efectivo+$tarjeta->obtenerMonto())) {
                    $tarjeta->restarSaldo($precio_efectivo);
                    $normaloplus="Normal";
                    $pago="Abona 1 viaje plus";
                    $mult=2;
                } else {
                    if ($tarjeta->obtenerPlus2()===FALSE) {
                        return FALSE;
                    }
                $tarjeta->CambiarPlus(2); //Si no tengo credito y ya use el plus1, puedo usar el plus2
                $normaloplus="Viaje Plus";
                $pago="";
                $mult=0;
                }
            } else {
                if ($tarjeta->obtenerSaldo()>=$precio_efectivo) {
                    $tarjeta->restarSaldo($precio_efectivo);
                    $normaloplus="Normal";
                    $pago="";
                    $mult=1;
                } else {
                    $tarjeta->CambiarPlus(1);
                    $normaloplus="Viaje Plus";
                    $pago="";
                    $mult=0;
                }
            }
        }
        $boleto=new Boleto($precio_efectivo, $this, $tarjeta, $precio_efectivo*$mult, $normaloplus, $pago, $fecha_actual);
        $tarjeta->CambiarUltBol($boleto);
        return $boleto;
    }

    public function pagarConMedio(TarjetaInterface $tarjeta, TiempoInterface $tiempo,$ultimo_boleto,$fecha_actual){
        if ($ultimo_boleto!=false) {
            $fechaUlt=$ultimo_boleto->obtenerFecha();
            if (($fecha_actual-$fechaUlt)>4) {
                return 0.5;
            }else {
                return 1;
            }
        } else {
            return 0.5;
        }
    }

    public function pagarConFranquiciaTotal(TarjetaInterface $tarjeta, TiempoInterface $tiempo){
        if ($tiempo->dia!=$tarjeta->fechaViaje1) {
            $tarjeta->fechaViaje1=$tiempo->dia;
            return 0;
        } elseif ($tiempo->dia!=$tarjeta->fechaViaje2) {
            $tarjeta->fechaViaje2=$tiempo->dia;
            return 0;
        } else {
            return 1;
        }
    }

    public function puedePagarDosPlus(TarjetaInterface $tarjeta, TiempoInterface $tiempo,$precio_efectivo){
        if($tarjeta->obtenerPlus2()==FALSE&&$tarjeta->obtenerSaldo()>=$precio_efectivo+($tarjeta->obtenerMonto()*2)){
            return TRUE;
        }
        return FALSE;
    }

    public function esTrasbordo(TarjetaInterface $tarjeta, TiempoInterface $tiempo) {
        
        $bol=$tarjeta->ObtenerUltBol();
        if ($bol!=NULL) {
            $tiempoDesdeTransbordo=($tiempo->tiempoactual)-($bol->obtenerFecha());
        } else {
            $tiempoDesdeTransbordo=120;
        }
        if (($tiempo->esDomingoFeriado()||$tiempo->esSabadoNoche())||$tiempo->esNoche()) {
            if ($tiempoDesdeTransbordo<91&&$tarjeta->ultViajeTrasbordo==FALSE) {
                $tarjeta->ultViajeTrasbordo=TRUE;
                return (1/3);
            }
        }
        if ($tiempo->esSabadoDia()||$tiempo->esSemanaDia()) {
            if ($tiempoDesdeTransbordo<61&&$tarjeta->ultViajeTrasbordo==FALSE) {
                $tarjeta->ultViajeTrasbordo=TRUE;
                return (1/3);
            }
        }
        $tarjeta->ultViajeTrasbordo=FALSE;
        return 1;
    }
}
?>