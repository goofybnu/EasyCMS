<?php
final class DBSqlInserir extends DBSqlInstrucao {
	public function setValorColuna($coluna, $valor){
		if (is_string($valor)) {
			$valor = addslashes($valor);
			$this->columnValues[$coluna] = "'$valor'";
		} elseif (is_bool($valor)) {
			$this->columnValues[$coluna] = $valor ? 'TRUE' : 'FALSE';
		} elseif (isset($valor)) {
			$this->columnValues[$coluna] = $valor;
		} else {
			$this->columnValues[$coluna] = "'NULL'";
		}
	}

	public function setCriterio($criterio){
		throw new Exception('Não executar setCreterio de'. __CLASS__);
	}

	public function getInstrucao(){
		$this->sql = "INSERT INTO {$this->entidade[0]} (";
		$colunas = implode(', ', array_keys($this->columnValues));
		$valores = implode(', ', array_values($this->columnValues));
		$this->sql.= $colunas . ')';
		$this->sql.= " VALUES ({$valores})";
		return ($this->sql);
	}
}
