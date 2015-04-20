<?php
final class DBSqlAtualizar extends DBSqlInstrucao {
	public function setValorColuna($coluna, $valor){
		if (is_string($valor)) {
			if(strlen($valor)>0){
				$valor = addslashes($valor);
				$this->columnValues[$coluna] = "'$valor'";
			} else {
				$this->columnValues[$coluna] = "NULL";
			}
		} elseif (is_bool($valor)) {
			$this->columnValues[$coluna] = $valor ? 'TRUE' : 'FALSE';
		} elseif (isset($valor)) {
			$this->columnValues[$coluna] = $valor;
		} else {
			$this->columnValues[$coluna] = "'NULL'";
		}
	}

	public function getInstrucao(){
		$this->sql  = "UPDATE {$this->entidade[0]}";
		if ($this->columnValues) {
			foreach ($this->columnValues as $coluna => $valor) {
				$set[] = "{$coluna} = {$valor}";
			}
		}
		$this->sql .= ' SET ' . implode(', ', $set);
		if ($this->criterio) {
			$this->sql .= " WHERE " . $this->criterio->dump();
		}
		return ($this->sql);
	}
}
