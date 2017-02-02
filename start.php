<?php

use TeamTNT\TNTSearch\TNTSearch;

require 'database.php';

require 'vendor/autoload.php';

$tnt = new TNTSearch;

$tnt->loadConfig([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'search',
    'username'  => 'root',
    'password'  => '',
    'storage'   => 'C:/xampp/htdocs/tntsearch',
	'charset' => 'utf8',
	'collation' => 'utf8_general_ci'
]);

function e($string) {

	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	
}