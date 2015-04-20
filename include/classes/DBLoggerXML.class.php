<?php
class DBLoggerXML extends DBLogger {
	public function write($mensagem){
		$dataHora = date("d/m/Y H:i:s");
		$texto = "<log>\n";
		$texto.= "	<dataHora>{$dataHora}</dataHora> : \n";
		$texto.= "	<mensagem>{$mensagem}</mensagem> <br />\n";
		$texto.= "</log>\n";
		$manipulador = fopen($this->nomeArquivo, 'a');
		fwrite($manipulador, $texto);
		fclose($manipulador);
	}
}
