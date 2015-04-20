<?php
class DBFiltroLivre extends DBExpressao {
	private $variavel;
	private $operador;
	private $valor;

	public function __construct($variavel, $operador = '', $valor = '') {
		$this->variavel = $variavel;
		$this->operador = '';
		$this->valor 	= '';
	}

	function dump(){
		return ("{$this->variavel}");
	}
}
