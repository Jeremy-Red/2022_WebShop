<?php
use wfm\App;

if (PHP_MAJOR_VERSION < 8) {
    die('PHP version less than 8 is not supported');
}
require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new App();
