<?php
abstract class DBExpressao {
	const AND_OPERADOR 		= 'AND ';
	const OR_OPERADOR 		= 'OR ';
	abstract public function dump();
}
