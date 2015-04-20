<?php
class DBConfig {
	var $config = array(
		'bancodedados' => array(
			'servidor' 		=> bdHost,
			'usuario' 		=> bdUser,
			'senha' 		=> bdPass,
			'bd' 			=> bdBase,
			'porta' 		=> bdPort,
			'tipo' 			=> bdType
		)
	);

	public function config(){
		return ($this->config);
	}
}
