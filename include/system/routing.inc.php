<?php
$_partes = array();
foreach (explode('/', $url) as $parte) {
	if ($parte !== '') {
		$pos = strpos($parte, '?');
		if ($pos !== false) {
			$parte = substr($parte, 0, $pos);
			if ($parte === '') {
				continue;
			}
		}
		$_partes[] = $parte;
	}
}

if (!empty($_partes[0]) && $_partes[0] == 'admin') {
	if(!empty($_partes[1]) && ($_partes[1] == 'login' || $_partes[1] == 'logout')){
		$primeiraParte = 1;
		$primeiroParam = 2;
	} else {
		$primeiraParte = 1;
		$primeiroParam = 3;
	}
	define('isAdmin',true);
} else if (!empty($_partes[0]) && ($_partes[0] == 'login' || $_partes[0] == 'logout')) {
	$primeiraParte = 0;
	$primeiroParam = 1;
	define('isAdmin',false);
} else {
	$primeiraParte = 0;
	$primeiroParam = 2;
	define('isAdmin',false);
}

if(isAdmin==true){
	$pastaPrincipal = 'admin';
} else {
	$pastaPrincipal = 'pages';
}

$partes = array();
for ($i = $primeiraParte; ($i < $primeiroParam) && ($i < count($_partes)); $i++) {
	$partes[] = $_partes[$i];
}

// Gravando parâmetros passados para o Array args[]
$args = array();
for ($i = $primeiroParam; $i < count($_partes); $i++) {
	$args[] = $_partes[$i];
}

// Definindo página padrão
if (empty($partes[0])) $partes[0] = defaultPage;

// Definindo arquivo padrão
if (empty($partes[1])) $partes[1] = defaultFile;

// Definindo extenção padrão
$extensao = '';
if (strrpos($partes[1], '.') === false) $extensao = defaultExtension;

if($partes[0]=='login' OR $partes[0]=='logout'){
	$file = implode(DIRECTORY_SEPARATOR, array(includePath,'system','sys_'.$partes[0].'.php'));
} else {
	// Definindo caminho do arquivo a ser carregado
	$file = implode(DIRECTORY_SEPARATOR, array(includePath,$pastaPrincipal,$partes[0],$partes[1].$extensao));
}
