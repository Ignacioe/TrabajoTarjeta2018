<?php

namespace TrabajoTarjeta;

interface ColectivoInterface {

    /**
     * Devuelve el nombre de la linea. Ejemplo '142 Negro'
     *
     * @return string
     */
    public function linea();

    /**
     * Devuelve el nombre de la empresa. Ejemplo 'Semtur'
     *
     * @return string
     */
    public function empresa();

    /**
     * Devuelve el numero de unidad. Ejemplo: 12
     *
     * @return int
     */
    public function numero();

    /**
     * Paga un viaje en el colectivo con una tarjeta en particular.
     *
     * @param TarjetaInterface $tarjeta
     * @param TiempoInterface $tiempo
     *
     * @return BoletoInterface|FALSE
     *  El boleto generado por el pago del viaje. O FALSE si no hay saldo
     *  suficiente en la tarjeta.
     */
    public function pagarCon(TarjetaInterface $tarjeta, TiempoInterface $tiempo);

    /**
     * Devuelve si ese dia y hora son validos para trasbordo
     *
     * @param TarjetaInterface $tarjeta
     * @param TiempoInterface $tiempo
     * 
     * @return int
     */
    public function esTrasbordo(TarjetaInterface $tarjeta, TiempoInterface $tiempo);

}
