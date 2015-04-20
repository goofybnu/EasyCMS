<?php
final class DBConexao extends DBConfig {
	private function __construct(){}

	public static function openCustom($servidor, $usuario, $senha, $bancoDeDados, $porta='3306', $tipo='mysql'){
		switch ($tipo) {
			case 'pgsql':
				$conexao = new PDO("pgsql:dbname={$bancoDeDados};user={$usuario};password={$senha};host={$servidor}");
				break;
			case 'mysql':
				try {
					$conexao = new PDO("mysql:host={$servidor};port={$porta};dbname={$bancoDeDados}", $usuario, $senha);
					$conexao->query('SET NAMES UTF8');
				} catch (Exception $e) {
					if(debugEnabled) die("ERROR: " . $e->getMessage());
					die('Site em manutenção. Tente mais tarde.');
				}
				break;
			default :
				$conexao = new PDO("mysql:host={$servidor};port={$porta};dbname={$bancoDeDados}", $usuario, $senha);
				break;
		}
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return ($conexao);
	}

	public static function open(){
		$DBConfig = new DBConfig;
		if (is_array($DBConfig->config['bancodedados'])) {
			if (empty($DBConfig->config['bancodedados']['servidor']) AND empty($DBConfig->config['bancodedados']['bd'])) {
				throw new Exception('Banco de dados não configurado.');
			}
		}
		$servidor 		= $DBConfig->config['bancodedados']['servidor'];
		$usuario 		= $DBConfig->config['bancodedados']['usuario'];
		$senha 			= $DBConfig->config['bancodedados']['senha'];
		$bancoDeDados 	= $DBConfig->config['bancodedados']['bd'];
		$porta 			= $DBConfig->config['bancodedados']['porta'];
		$tipo 			= $DBConfig->config['bancodedados']['tipo'];
		switch ($tipo) {
			case 'pgsql':
				$conexao = new PDO("pgsql:dbname={$bancoDeDados};user={$usuario};password={$senha};host={$servidor}");
				break;
			case 'mysql':
				try {
					$conexao = new PDO("mysql:host={$servidor};port={$porta};dbname={$bancoDeDados}", $usuario, $senha);
					$conexao->query('SET NAMES UTF8');
				} catch (Exception $e) {
					if(debugEnabled) die("ERROR: " . $e->getMessage());
					die('Site em manutenção. Tente mais tarde.');
				}
				break;
			default :
				$conexao = new PDO("mysql:host={$servidor};port={$porta};dbname={$bancoDeDados}", $usuario, $senha);
				break;
		}
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return ($conexao);
	}
}
