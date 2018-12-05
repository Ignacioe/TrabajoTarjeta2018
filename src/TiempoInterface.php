<?php
namespace TrabajoTarjeta;

interface TiempoInterface {
    /**
     * Avanza cierta cantidad de minutos.
     *
     * @param float $cantMinutos
     */
    public function avanzar($cantMinutos);
}