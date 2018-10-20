<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;
   // protected $tarjeta;
   // protected $colectivo;
    protected $fecha;
    protected $tipoDeTarjeta;
    protected $totalAbonado;
    protected $IDtarjeta;
    protected $lineaDeColectivo;
    protected $tipoBoleto;


    public function __construct($valor, $colectivo, $tarjeta, $totalAbonado, $tipoBoleto) {
        $this->valor = $valor;
        $this->lineaDeColectivo = $colectivo->linea();
        $this->tipoTarjeta = get_class($tarjeta);
        $this->fecha = date('d-m-Y H:i:s');
        $this->totalAbonado = $totalAbonado;
        $this->IDtarjeta= $tarjeta->obtenerID();
        $this->tipoBoleto = $tipoBoleto;

    }

    public function obtenerValor() {
        return $this->valor;
    }

    public function obtenerColectivo() {
        return $this->colectivo;
    }

}
