<?php
final class RelatoriosDBConexao extends DBConfig {
	private function __construct(){}

	public static function open(){
		$servidor 		= RelatoriosDbHost;
		$usuario 		= RelatoriosDbUser;
		$senha 			= RelatoriosDbPass;
		$bancoDeDados 	= RelatoriosDbBase;
		$porta 			= RelatoriosDbPort;
		$tipo 			= RelatoriosDbType;
		switch ($tipo) {
			case 'pgsql':
				$conexao = new PDO("pgsql:dbname={$bancoDeDados};user={$usuario};password={$senha};host={$servidor}");
				break;
			case 'mysql':
				try {
					$conexao = new PDO("mysql:host={$servidor};port={$porta};dbname={$bancoDeDados}", $usuario, $senha);
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
