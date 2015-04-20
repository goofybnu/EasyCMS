<?php
abstract class DBLogger {
	protected $nomeArquivo;

	public function __construct($nomeArquivo){
		$this->nomeArquivo = $nomeArquivo;
	}

	abstract function write($menssage);
}
