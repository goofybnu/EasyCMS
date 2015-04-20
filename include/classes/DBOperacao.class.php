<?php
final class DBOperacao {
	private static $conexao;
	private static $logger;

	private function __construct(){}

	public static function open(){
		if (empty(self::$conexao)) {
			self::$conexao = DBConexao::open();
			self::$conexao->beginTransaction();
			self::$logger = NULL;
		}
	}

	public static function get(){
		return (self::$conexao);
	}

	public static function rollback(){
		if (self::$conexao) {
			self::$conexao->rollback();
			self::$conexao = NULL;
		}
	}

	public static function close(){
		if (self::$conexao) {
			self::$conexao->commit();
			self::$conexao = NULL;
		}
	}

	public static function setLogger(DBLogger $logger){
		self::$logger = $logger;
	}

	public static function log($mensagem){
		if (self::$logger) {
			self::$logger->write($mensagem);
		}
	}
}
