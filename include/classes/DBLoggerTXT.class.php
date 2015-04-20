<?php
class DBLoggerTXT extends DBLogger {
	public function write($mensagem){
		$dataHora = date("d/m/Y H:i:s");
		$texto = "{$dataHora} :: {$mensagem}\n";
		$manipulador = fopen($this->nomeArquivo, 'a');
		fwrite($manipulador, $texto);
		fclose($manipulador);
	}
}
