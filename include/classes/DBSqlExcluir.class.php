<?php
final class DBSqlExcluir extends DBSqlInstrucao {
	public function getInstrucao(){
		$this->sql = "DELETE FROM {$this->entidade[0]}";
		if ($this->criterio) {
			$expressao = $this->criterio->dump();
			if ($expressao) {
				$this->sql .= ' WHERE ' . $expressao;
			}
		}
		return ($this->sql);
	}
}
