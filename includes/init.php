<?php

//require dirname(__DIR__) . '/config.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'librarian');
define('DB_USER', 'cms_www');
define('DB_PASS', 'UXb9ARqrf5UhLSo2');



spl_autoload_register( function($class) {
     require dirname(__DIR__) . "/classes/{$class}.php";
 });
 
session_start();



