<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;
    protected $fecha;
    protected $tipoDeTarjeta;
    protected $totalAbonado;
    protected $IDtarjeta;
    protected $lineaDeColectivo;
    protected $tipoBoleto;
    protected $descripcion;

    public function __construct($valor, $colectivo, $tarjeta, $totalAbonado, $tipoBoleto,$descripcion, $fecha) {
        $this->valor = $valor;
        $this->lineaDeColectivo = $colectivo->linea();
        $this->tipoTarjeta = get_class($tarjeta);
        $this->fecha = $fecha;
        $this->totalAbonado = $totalAbonado;
        $this->IDtarjeta= $tarjeta->obtenerID();
        $this->tipoBoleto = $tipoBoleto;
        $this->descripcion = $descripcion;
    }

    public function obtenerValor() {
        return $this->valor;
    }

    public function obtenerColectivo() {
        return $this->colectivo;
    }

    public function obtenerFecha() {
        return $this->fecha;
    }

    public function obtenerTipoBoleto(){
        return $this->tipoBoleto;
    }
}
