<?php
namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface {

	protected $tiempo;
	protected $feriado;

	public function __construct ($inicia = 0, $feriado = false){
		$this->tiempo = $inicia;
		$this->feriado = $feriado;
	}	

	public function Avanzar($segundos){
		$this->tiempo += $segundos;
	}

	public function time(){
		return $this->tiempo;
	}

	public function esFeriado(){
		return $this->feriado;	
	}

}


