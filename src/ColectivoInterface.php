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
     * Realiza los pasos extra que hay que hacer si se paga con una franquicia media.
     *
     * @param TarjetaInterface $tarjeta
     * @param TiempoInterface $tiempo
     *
     * @return int
     *  El multiplicador, 0.5 si se paga medio boleto, 1 si se paga normal.
     */
    public function pagarConMedio(TarjetaInterface $tarjeta, TiempoInterface $tiempo);

    /**
     * Realiza los pasos extra que hay que hacer si se paga con una franquicia total.
     *
     * @param TarjetaInterface $tarjeta
     * @param TiempoInterface $tiempo
     *
     * @return int
     *  El multiplicador, 0 si es gratis, 1 si se paga normal.
     */
    public function pagarConFranquiciaTotal(TarjetaInterface $tarjeta, TiempoInterface $tiempo);

    /**
     * Corrobora si se tiene saldo suficiete para abonar dos viajes plus mas el boleto actual.
     *
     * @param TarjetaInterface $tarjeta
     * @param TiempoInterface $tiempo
     * @param $precio_efectivo
     * 
     * @return bool
     *  TRUE si tiene saldo suficiente para pagar 2 vaijes plus mas su boleto actual, FALSE si no alcanza.
     */
    public function puedePagarDosPlus(TarjetaInterface $tarjeta, TiempoInterface $tiempo,$precio_efectivo);

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
