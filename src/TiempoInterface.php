<?php
namespace TrabajoTarjeta;

interface TiempoInterface {
    /**
     * Avanza cierta cantidad de minutos.
     *
     * @param float $cantMinutos
     */
    public function avanzar($cantMinutos);

    /**
     * Corrobora si es de Noche y Sabado.
     * @return bool
     */
    public function esSabadoNoche();

    /**
     * Corrobora si es de Dia y Sabado.
     * @return bool
     */
    public function esSabadoDia();

    /**
     * Corrobora si es de Noche.
     * @return bool
     */
    public function esNoche();

    /**
     * Corrobora si es horario permitido para trasbordo los dias domingos y feriados.
     * @return bool
     */
    public function esDomingoFeriado();

    /**
     * Corrobora si es de Dia y dia de Semana.
     * @return bool
     */
    public function esSemanaDia();
}