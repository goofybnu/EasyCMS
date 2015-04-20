<?php
class DBLoggerHTML extends DBLogger {
	public function write($mensagem){
		$dataHora = date("d/m/Y H:i:s");
		$texto = "<p>\n";
		$texto.= "	<b>{$dataHora}</b> : \n";
		$texto.= "	<i>{$mensagem}</i> <br />\n";
		$texto.= "</p>\n";
		$manipulador = fopen($this->nomeArquivo, 'a');
		fwrite($manipulador, $texto);
		fclose($manipulador);
	}
}
