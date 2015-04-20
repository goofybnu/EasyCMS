<?php
Abstract Class SYSLogin {
	private static $instancia = null;

	private function __construct() {}

	public static function instanciar() {
		if (self::$instancia == NULL) {
			self::$instancia = new SYSLoginDB();
		}
		return self::$instancia;
	}

	public abstract function login($login, $senha);
	public abstract function logout();
	public abstract function checar();
	public abstract function retornar();
}

