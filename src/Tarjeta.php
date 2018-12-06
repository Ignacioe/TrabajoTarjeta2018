<?php
namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;
    protected $ID;
    protected $viajesPlus1;
    protected $viajesPlus2;
    protected $monto = 15;
    public $Ult_boleto;
    protected $tipo;
    public $primerViaje;
    protected $ultViajeTransbordo = FALSE;//indica si el ultimo viaje fue transbordo

    public function __construct() {
        $this->saldo = 0.0;
        $this->ID = rand();
        $this->viajesPlus1 = true;
        $this->viajesPlus2 = true;
        $this->Ult_boleto;
        $this->tipo = "Normal";
        $this->primerViaje = true;
    }

	public function UltimoTransbordo(){
	
		return $this->ultViajeTransbordo; //TRUE si el ultimo viaje fue transbordo, FALSE en caso contrario
	}

    public function recargar($monto) {
        if ($monto == 10 || $monto == 20 || $monto == 30 || $monto == 50 || $monto == 100) {
            $this->saldo += $monto;
            return true;
        }

        if ($monto == 962.59) {
                $this->saldo += $monto;
                $this->saldo += 221.58;
                return true;
        }

        if ($monto == 510.15) {
                $this->saldo += $monto;
                $this->saldo += 81.93;
                return true;
        }
        return false;
    }


    public function obtenerSaldo() {
        return $this->saldo;
    }

    public function CambiarUltBol($boleto) {
        $this->Ult_boleto = $boleto;
        return true;
    }

    public function ObtenerUltBol() {
        return $this->Ult_boleto;
    }
	
    public function obtenerID() {
        return $this->ID;
    }

    public function obtenerPlus1() {
        return $this->viajesPlus1;
    }

    public function obtenerPlus2() {
        return $this->viajesPlus2;
    }

    public function obtenerTipo() {
        return $this->tipo;
    }
  
    public function CambiarPlus($op) {
        if ($op == 1) {
            $this->viajesPlus1 = false;
        } else {
            $this->viajesPlus2 = false;
        }
    }
	
    public function obtenerMonto() {
        return $this->monto;
    }

    public function restarSaldo($precio_efectivo) {
    
            if ($this->viajesPlus2 === false) { 						//Si viaje plus2 es false, tengo que pagar 2 plus y un boleto.
            $this->viajesPlus1 = true; //Cambio los plus a true
            $this->viajesPlus2 = true;
                $this->saldo -= ($this->obtenerMonto() * 2+$precio_efectivo); //le resto al saldo los 2 plus y el boleto
                return;
            } else {
            if ($this->viajesPlus1 === false) {					//Si solo tengo que pagar 1 plus
                    $this->viajesPlus1 = true;
                    $this->saldo -= ($this->obtenerMonto()+$precio_efectivo); //Resto el plus y 1 boleto
                    return;
                } else {
                $this->saldo -= $precio_efectivo;	
                return;
            }
            }
    }
}


