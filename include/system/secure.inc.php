<?php
$aut = SYSLogin::instanciar();
$usuario = null;
if ($aut->checar()) {
	$usuario = $aut->retornar();
	$possuiAcesso = false;
	if($usuario->tipo!='ADMIN'){
		foreach($usuario->permissoes AS $item){
			if(strpos($url, $item) !== false) {
				$possuiAcesso = true;
			}
		}
	} else {
		$possuiAcesso = true;
	}
	if($possuiAcesso != true){
		$file = implode(DIRECTORY_SEPARATOR, array(includePath,'system','err_permissao.inc.php'));
	}
} else {
	$aut->logout();
}
