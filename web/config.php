<?php
// Path Config
define('includePath', 				realpath('./../include/'));
define('classesPath', 				realpath('./../include/classes/'));

// URL Config
define('baseURL', 					'/');

// Security Config
define('useSecure', 				true);
define('unsecurePages', 			serialize(array('home', 'login','logout')));

// Admin Security Config
define('useSecureAdmin', 			true);
define('unsecureAdminPages', 		serialize(array('home','login','logout')));

// Defaults Config
define('defaultPage', 				'home');
define('defaultFile', 				'index');
define('defaultExtension', 			'.php');

// Development Config
//define('debugEnabled', 				true);
define('maintenanceEnabled', 		false);

// Database Config
define('bdHost', 					'localhost');
define('bdUser', 					'root');
define('bdPass', 					'qaswed999');
define('bdBase', 					'erp');
define('bdPort', 					'3306');
define('bdType', 					'mysql');

