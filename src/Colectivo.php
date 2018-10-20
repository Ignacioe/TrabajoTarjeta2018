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
    	if($tarjeta->obtenerPlus2() == FALSE && $tarjeta->obtenerSaldo() >= ($tarjeta->obtenerMonto()*3)){
            $tarjeta->restarSaldo();
            $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta);
            return $boleto;
        }
        else{
            if($tarjeta->obtenerPlus1() == FALSE ){
                if ($tarjeta->obtenerSaldo() >= ($tarjeta->obtenerMonto()*2)){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta);
                    return $boleto;
                }
                else{
                    if($tarjeta->obtenerPlus2() == FALSE){
                        return FALSE;
                    }
                    $tarjeta->CambiarPlus(2);               //Si no tengo credito y ya use el plus1, puedo usar el plus2
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta);
                    return $boleto;
                }
            }
            else{
                if($tarjeta->obtenerSaldo() >= $tarjeta->obtenerMonto()){
                    $tarjeta->restarSaldo();
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta);
                    return $boleto;
                }
                else{
                    $tarjeta->CambiarPlus(1);
                    $boleto= new Boleto($tarjeta->obtenerMonto(),$this,$tarjeta);
                    return $boleto;  
                }
            }
        }
    }
}
?>