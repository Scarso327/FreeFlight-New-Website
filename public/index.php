<?php

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("WEB", ROOT . 'public' . DIRECTORY_SEPARATOR);
define("VIEWS", ROOT . 'views' . DIRECTORY_SEPARATOR);

include("../includes.php");

define('SETTING', require ROOT.'settings.php');

define('URL_PROTOCOL', ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"));
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL', URL_PROTOCOL . URL_DOMAIN . '/');

// Database Settings
define('DB_TYPE', SETTING["db-type"]);
define('DB_HOST', SETTING["db-host"]);
define('DB_NAME', SETTING["db-name"]);
define('DB_USER', SETTING["db-user"]);
define('DB_PASS', SETTING["db-pass"]);
define('DB_CHARSET', SETTING["db-set"]);

define("DefaultController", "home");

new Application;