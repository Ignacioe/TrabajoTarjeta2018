<?php 

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea;

    protected $empresa;

    protected $numero;

    public function __construct($linea, $empresa, $numero) {
        $this->linea = $linea;
        $this->empresa = $empresa;
        $this->numero = $numero;
    }

   /**
     * Devuelve el nombre de la linea. Ejemplo '142 Negro'
     *
     * @return string
     */
    public function linea(){
    	return $this->linea;
    }

    /**
     * Devuelve el nombre de la empresa. Ejemplo 'Semtur'
     *
     * @return string
     */
    public function empresa(){
    	return $this->empresa;
    }

    /**
     * Devuelve el numero de unidad. Ejemplo: 12
     *
     * @return int
     */
    public function numero(){
    	return $this->numero;
    }

    /**
     * Paga un viaje en el colectivo con una tarjeta en particular.
     *
     * @param TarjetaInterface $tarjeta
     *
     * @return BoletoInterface|FALSE
     *  El boleto generado por el pago del viaje. O FALSE si no hay saldo
     *  suficiente en la tarjeta.
     */
    public function pagarCon(TarjetaInterface $tarjeta){
    	
        if($tarjeta->obtenerSaldo() < 14.80 && ( $viajesPlus1 == TRUE || $viajesPlus2 == TRUE ) ){
            if($tarjeta->viajesPlus1 == TRUE){
                $tarjeta->CambiarPlus(1);
                $boleto= new Boleto(0,NULL,NULL);
                return $boleto;

            }
            else{
                if($tarjeta->viajesPlus2 == TRUE){
                    $tarjeta->CambiarPlus(2);
                    $boleto = new Boleto (0,NULL, NULL);
                    return $boleto;
                }
                else{
                    return FALSE;
                }
            }

        }

        else{
            
            $tarjeta->restarSaldo();
            $boleto= new Boleto(14.80,$this,$tarjeta);
            return $boleto;
            }
    		
    	}

}
?>