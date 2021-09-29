<?php

//require dirname(__DIR__) . '/config.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'librarian');
define('DB_USER', 'root');
define('DB_PASS', '');



spl_autoload_register( function($class) {
     require dirname(__DIR__) . "/classes/{$class}.php";
 });
 
session_start();



