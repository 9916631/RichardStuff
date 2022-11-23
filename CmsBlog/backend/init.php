<?php
session_start();

spl_autoload_register(function($class){
    require 'classes/'.$class.'.php';
});


define("DB_HOST", "localhost");
define("DB_NAME", "redquing_blogger");
define("DB_USER", "redquing_admin");
define("DB_PASS", "admin");
define("BASE_URL", "https://redqueengaming.net/cmsblog/");

//$validate = new Validate;
$userObj = new Users;
?>