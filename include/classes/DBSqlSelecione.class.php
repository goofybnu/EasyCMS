<?php
final class DBSqlSelecione extends DBSqlInstrucao {
	private $colunas = array();

	public function addColuna($coluna){
		$this->colunas[] = $coluna;
	}

	public function getInstrucao(){
		$this->sql = "SELECT ";
		if (is_array($this->colunas) AND strlen($this->colunas[0])){
			$this->sql .= implode(', ', $this->colunas);
		}else{
			$this->sql .= '*';
		}
		$this->sql .= " FROM " . implode(', ',$this->entidade);
		if ($this->criterio) {
			$expressao = $this->criterio->dump();
			if ($expressao) {
				$this->sql .= " WHERE ". $expressao;
			}
			$ordem  = $this->criterio->getPropriedade('order');
			$group  = $this->criterio->getPropriedade('group');
			$limite = $this->criterio->getPropriedade('limit');
			$offset = $this->criterio->getPropriedade('offset');
			if ($group) {
				$this->sql .= " GROUP BY ". $group;
			}
			if ($ordem) {
				$this->sql .= " ORDER BY ". $ordem;
			}
			if ($limite) {
				$this->sql .= " LIMIT ". $limite;
			}
			if ($offset) {
				$this->sql .= " OFFSET ". $offset;
			}
		}
		if(debugEnabled) echo SQLFormatPHP($this->sql);
		return ($this->sql);
	}
}
