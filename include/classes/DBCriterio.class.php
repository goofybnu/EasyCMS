<?php 
class DBCriterio extends DBExpressao {
	private $expressoes;
	private $operadores;
	private $propriedades;

	public function add(DBExpressao $expressao, $operador = self::AND_OPERADOR){
		if (empty($this->expressoes)) {
			unset($operador);
		}
		$this->expressoes[] = $expressao;  
		$this->operadores[] = @$operador;
	}

	public function dump(){
		$resultado = '';
		if (is_array($this->expressoes)) {
			foreach ($this->expressoes as $i => $expressao) {
				$operador = $this->operadores[$i];
				$resultado .= $operador. $expressao->dump(). ' ';
			}
			$resultado = trim($resultado);
			return "({$resultado})";
		}
	}

	public function setPropriedade($propriedade, $valor){
		$this->propriedades[$propriedade] = $valor;
	}

	public function getPropriedade($propriedade){
		return (@$this->propriedades[$propriedade]);
	}
}
