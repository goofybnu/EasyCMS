<?php 
abstract class DBSqlInstrucao {
	protected $sql;
	protected $criterio;

	final public function setEntidade($entidade){
		$this->entidade[] = $entidade;
	}

	function getEntidade(){
		return ($this->entidade);
	}

	public function setCriterio(DBCriterio $criterio){
		$this->criterio = $criterio;
	}

	abstract function getInstrucao();
}
