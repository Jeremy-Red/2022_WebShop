<?php

define('DEBUG', 1);
define('ROOT', dirname(__DIR__));
define('WWW', ROOT . '/public');
define('APP', ROOT . '/app');
define('CORE', ROOT . '/vendor/wfm');
define('HELPERS', CORE . '/helpers');
define('CACHE', ROOT . '/tmp/cache');
define('LOGS', ROOT . '/tmp/logs');
define('CONFIG', ROOT . '/config');
define('LAYOUT', 'ishop');
define('PATH', 'http://localhost');
define('ADMIN', PATH . '/admin');
define('NO_IMAGE', 'updloads/no-image.jpg');

require_once ROOT . '/vendor/autoload.php';