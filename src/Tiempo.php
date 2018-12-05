<?php
namespace TrabajoTarjeta;

class Tiempo implements TiempoInterface {
    private $feriados = [1,63,64,83,92,109,121,145,168,171,190,229,285,322,342,359,365];
    public $tiempoactual=0;
    public $minutos=0;
    public $hora=0;
    public $dia=1;
    
    public function avanzar($cantMinutos){
        if($this->tiempoactual+$cantMinutos>1439){
            $this->dia+=intdiv($this->tiempoactual+$cantMinutos,1440);
            $this->hora=0;
            $this->minutos=0;
            if($this->dia>365){
                $this->dia-=365;
            }
            $this->tiempoactual+=($this->dia*1440);
            $cantMinutos=($this->tiempoactual+$cantMinutos)%1440;
        }
        if($this->minutos+$cantMinutos>59){
            $this->hora+=intdiv($this->minutos+$cantMinutos,60);
            $this->minutos=($this->minutos+$cantMinutos)%60;
        } else {
            $this->minutos+=$cantMinutos;
        }
        $this->tiempoactual+=$cantMinutos;
    }
}