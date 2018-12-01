<?php

namespace TrabajoTarjeta;

interface BoletoInterface {

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor();

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo();

    /**
     * Devuelve la fecha en la que se pagó el boleto.
     *
     * @return string
     */
    public function obtenerFecha();

    /**
     * Devuelve el tipo de boleto que se paga.
     *
     * @return string
     */
    public function obtenerTipoBoleto();

 
}
