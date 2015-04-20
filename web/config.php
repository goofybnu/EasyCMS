<?php
// Path Config
define('includePath', 			realpath('./../include/'));
define('classesPath', 			realpath('./../include/classes/'));

// URL Config
define('baseURL', 			'/');

// Security Config
define('useSecure', 			true);
define('unsecurePages', 		serialize(array('home', 'login','logout')));

// Admin Security Config
define('useSecureAdmin', 		true);
define('unsecureAdminPages', 		serialize(array('home','login','logout')));

// Defaults Config
define('defaultPage', 			'home');
define('defaultFile', 			'index');
define('defaultExtension', 		'.php');

// Development Config
define('maintenanceEnabled', 		true);
define('bypassmaintenance', 		serialize(array('189.45.192.4')));

// Database Config
define('bdHost', 			'localhost');
define('bdUser', 			'root');
define('bdPass', 			'c14R63$25');
define('bdBase', 			'erp');
define('bdPort', 			'3306');
define('bdType', 			'mysql');
?>
