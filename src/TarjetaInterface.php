<?php

namespace TrabajoTarjeta;

interface TarjetaInterface {

    /**
     * Recarga una tarjeta con un cierto valor de dinero.
     *
     * @param float $monto
     *
     * @return bool
     *   Devuelve TRUE si el monto a cargar es válido, o FALSE en caso de que no
     *   sea valido.
     */
    public function recargar($monto);

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo();

    /**
     * Devuelve true despues de actualizar cual fue el ultimo boleto pagado
     * @param float $boleto
     * 
     * @return bool
     */
    public function CambiarUltBol($boleto);

    /**
     * Devuelve el ultimo boleto pagado.
     *
     * @return BoletoInterface
     */
    public function ObtenerUltBol();

    /**
     * Devuelve la ID de la tarjeta.
     *
     * @return int
     */
    public function obtenerID();

    /**
     * Devuelve si se ha usado el primer viaje plus.
     *
     * @return bool
     */
    public function obtenerPlus1();

    /**
     * Devuelve si se ha usado el ultimo viaje plus.
     *
     * @return bool
     */
    public function obtenerPlus2();

    /**
     * Devuelve el tipo la tarjeta.
     *
     * @return string
     */
    public function obtenerTipo();

    /**
     * Cambia el valor de TRUE a FALSE dependiendo de con cual viaje plus se esta pagando.
     * @param int $op

     * @return bool
     */
    public function CambiarPlus($op);

    /**
     * Devuelve cuanto se paga con este tipo de tarjeta.
     *
     * @return int
     */
    public function obtenerMonto();

    /**
     * Cambia el saldo de la tarjeta si se tiene suficiente saldo para pagar el boleto, sino paga con un Plus.
     *
     */
    public function restarSaldo();



   

}
