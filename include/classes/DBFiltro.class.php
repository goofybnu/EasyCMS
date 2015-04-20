<?php
class DBFiltro extends DBExpressao {
	private $variavel;
	private $operador;
	private $valor;

	public function __construct($variavel, $operador, $valor){
		$this->variavel = $variavel;
		$this->operador = $operador;
		$this->valor 	= $this->transformar($valor);
	}

	public function transformar($valor){
		if (is_array($valor)) {
			foreach ($valor as $x) {
				if (is_integer($x)) {
					$foo[] = $x;
				} elseif (is_string($x)) {
					$foo[] = "'$x'";
				}
			}
			$resultado = '(' . implode(',', $foo) . ')'; 
		} elseif ((substr($valor, 0, 1) != '[') AND (substr($valor, -1) != ']')) {
			$resultado = "'$valor'";
		} elseif (is_null($valor)) {
			$resultado = 'NULL';
		} elseif (is_bool($valor)) {
			$resultado = $valor ? 'TRUE' : 'FALSE';
		} elseif((substr($valor, 0, 1) == '[') AND (substr($valor, -1) == ']')){
			$arrRemover = array('[',']');
			$valor = str_replace($arrRemover, '', $valor);
			$resultado = $valor;
		} else {
			$resultado = $valor;
		}
		return ($resultado);
	}

	function dump(){
		return ("{$this->variavel} {$this->operador} {$this->valor}");
	}
}
