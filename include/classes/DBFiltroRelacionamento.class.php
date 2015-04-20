<?php
class DBFiltroRelacionamento extends DBExpressao {
	private $variavel;
	private $operador;
	private $valor;

	public function __construct($variavel, $operador, $valor) {
		$this->variavel = $variavel;
		$this->operador = $operador;
		$this->valor 	= $valor;
	}

	function dump(){
		return ("{$this->variavel} {$this->operador} {$this->valor}");
	}
}
