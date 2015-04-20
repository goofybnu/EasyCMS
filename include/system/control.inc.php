<?php
// Basic System Control File
$customCSS = array();
$customJS = array();

// Adicionando arquivo de funções
require_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','functions.inc.php')));

// Verifica caminho requisitado
if(baseURL=='/'){
	$url = substr($_SERVER['REQUEST_URI'], 1);
} else {
	$url = str_replace(baseURL, '', $_SERVER['REQUEST_URI']);
}

// Seta o locale
setlocale(LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil.1252');

// Incluindo arquivo de roteamento
require_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','routing.inc.php')));

if(end($_partes)=='true'){
	define('debugEnabled', true);
	error_reporting(E_ALL|E_STRICT);
	ini_set('display_errors', '1');
	define('PARSER_LIB_ROOT', implode(DIRECTORY_SEPARATOR, array(includePath,'system/sqlparserlib'))."/");
	require_once PARSER_LIB_ROOT."sqlparser.lib.php";
	function SQLFormatPHP($sql){
		return '<pre class="syntax_pre">' . PMA_SQP_formatHtml(PMA_SQP_parse($sql), 'color') . '</pre>';
	}
} else {
	define('debugEnabled', false);
	error_reporting(0);
	ini_set('display_errors', '0');
}

if(isAdmin==true){
	// Adicionando arquivo com as funçoes do admin
	require_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','functions.admin.inc.php')));

	// Adiciona arquivo que controla a segurança
	if(useSecureAdmin==true AND $partes[0]!='login' AND !in_array($partes[0], unserialize(unsecureAdminPages))){
		require_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','secure.admin.inc.php')));
	}

	// Redirecionar se a página não existe
	if(!is_file($file)){
		$file = implode(DIRECTORY_SEPARATOR, array(includePath,'system','err_404.admin.inc.php'));
	}
} else {

	// Adiciona arquivo que controla a segurança
	if(useSecure==true AND $partes[0]!='login' AND !in_array($partes[0], unserialize(unsecurePages))){
		require_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','secure.inc.php')));
	}

	// Redirecionar se a página não existe
	if(!is_file($file)){
		$file = implode(DIRECTORY_SEPARATOR, array(includePath,'system','err_404.inc.php'));
	}

	// Exibe aviso de manutenção se ativo
	if(maintenanceEnabled AND !in_array($_SERVER['REMOTE_ADDR'], unserialize(bypassmaintenance))){
		$file = implode(DIRECTORY_SEPARATOR, array(includePath,'system','maintenance.inc.php'));
	}
}

// Atualiza o diretorio corrente
chdir(dirname($file));

// Carrega a página solicitada
if(!isset($_REQUEST['ajax']) AND ($partes[0]!='login' OR ($partes[0]=='login' AND $_SERVER['REQUEST_METHOD']!='POST')) AND $partes[0]!='logout')
	include_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','head.inc.php')));
include($file);
if(!isset($_REQUEST['ajax']) AND ($partes[0]!='login' OR ($partes[0]=='login' AND $_SERVER['REQUEST_METHOD']!='POST')) AND $partes[0]!='logout')
	include_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','foot.inc.php')));
